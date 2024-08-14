$(document).ready(function () {

    loadReportsData({});

    loadDashboardData();

    loadCourses();

    populatePromoters();

});

// Functions

function loadCourses() {
    $.ajax({
        url: 'http://localhost:8080/obtenerTodosCursos',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            let rows = '';
            data.forEach(course => {
                rows += `
                            <div class="col-md-4 mb-4">
                                <div class="card course-card">
                                    <img width="96" height="96" src="${course.img1}" alt="${course.name}"/>
                                    <div class="card-body">
                                        <h5 class="card-title">${course.name}</h5>
                                        <div class="d-flex justify-content-between">
                                        <button id="btnCourseInfo" class="btn btn-info btn-sm">Info</button>
                                        <button id="btnDeleteCourse" class="btn btn-danger btn-sm" data-id="${course.id}">Delete</button>
                                    </div>
                                </div>
                            </div>
                        `;
            });
            $('#coursesCards').html(rows);
        }
    });
}

function saveCourse() {
    $.ajax({
        type: "POST",
        url: "http://localhost:8080/guardarCurso",
        data: data,
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                alert("Course saved successfully.");
                // Optionally, reload courses or reset form
                $("#newCourseForm")[0].reset();
            } else {
                alert("Failed to save the course. Please try again.");
            }
        },
        error: function (xhr, status, error) {
            console.error("Error saving course:", error);
            alert("An error occurred while saving the course. Please try again.");
        }
    });
}

function deleteCourse(id) {
    console.log("Attempting to delete course with ID:", id);

    $.ajax({
        type: "DELETE",
        url: `http://localhost:8080/eliminarCurso/${id}`,
        dataType: "JSON",
        success: function (response) {
            console.log("Server response:", response);
            if (response === 1) {
                // Successfully deleted
                loadCourses();
            } else {
                // Failed to delete
                alert("Failed to delete the course. Please try again.");
            }
        }
    });
}

function loadDashboardData() {
    $.ajax({
        url: 'http://localhost:8080/obtenerTodosCursos', // Replace with your endpoint URL
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Dashboard data received:", data); // Debugging line to check the data
            // Assuming 'data' is an array of course objects
            let rows = '';
            data.forEach(course => {
                rows += `
                            <tr>
                                <td>${course.name}</td>
                                <td>${course.duration}</td>
                                <td>${course.modalidad}</td>
                                <td>${course.category}</td>
                                <td>${course.price}</td>
                                <td>${course.promotor}</td>
                                <td>${course.inscription_count}</td>
                            </tr>
                        `;
            });
            $('#coursesTable tbody').html(rows);
        }
    });
}

function loadReportsData(filters) {
    let url = 'http://localhost:8080/filtrarCursos';
    if (filters.category) {
        url += `/${filters.category}`;
    }

    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        success: function (data) {
            console.log("Filtered data received:", data); // Debugging line
            let rows = '';
            data.forEach(course => {
                rows += `
                        <tr>
                            <td>${course.name}</td>
                            <td>${course.duration}</td>
                            <td>${course.modalidad}</td>
                            <td>${course.category}</td>
                            <td>${course.price}</td>
                            <td>${course.promotor}</td>
                            <td>${course.inscription_count}</td>
                        </tr>
                    `;
            });
            $('#reportsTable tbody').html(rows);
        }
    });
}

function populatePromoters() {
    $.ajax({
        url: 'http://localhost:8080/obtenerTodosPromotores',
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            // Clear existing options
            $('#promoterName').empty();
            $('#promoterName').append('<option value="" disabled selected>Select a promoter</option>');

            // Populate the dropdown with options
            $.each(data, function (index, promoter) {
                $('#promoterName').append('<option value="' + promoter.id + '">' + promoter.name + '</option>');
            });
        }
    });
}

function convertImageToBase64(file, callback) {
    const reader = new FileReader();
    reader.onloadend = function () {
        callback(reader.result);
    };
    reader.readAsDataURL(file);
}

function submitFormData(formData) {
    $.ajax({
        url: 'http://localhost:8080/guardarCurso', // Replace with your server endpoint URL
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            // Handle success
            console.log('Form submitted successfully:', response);
        },
        error: function (jqXHR, textStatus, errorThrown) {
            // Handle error
            console.error('Form submission failed:', textStatus, errorThrown);
        }


    });
}

function refreshCourses() {
    $('#newCourseForm')[0].reset();
    $('#newCourseModal').modal('hide'); // Replace #myModal with your modal ID

    // Optionally, you can also clear file inputs
    $('#additionalImage1').val('');
    $('#additionalImage2').val('');
    loadCourses();
    // Change URL without reloading the page
    window.history.pushState({}, document.title, 'http://localhost/elprofegalleta-v2/dashboard.php');

}

function CustomMsgBox(icon, title, text, footer) {
    let timerInterval;
    Swal.fire({
        icon: icon,
        title: title,
        text: text,
        timer: 1500,
        timerProgressBar: false,
        didOpen: () => {
            Swal.showLoading();
            const timer = Swal.getPopup().querySelector("b");
            timerInterval = setInterval(() => {
                timer.textContent = `${Swal.getTimerLeft()}`;
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log("I was closed by the timer");
        }
    });
}

function exportTableToPDF() {

    const { jsPDF } = window.jspdf;
    html2canvas(document.querySelector("#reportsTable")).then(canvas => {
        // Create a new jsPDF instance
        const pdf = new jsPDF('l', 'pt', 'a4');

        // Get the canvas image
        const imgData = canvas.toDataURL('image/png');

        // Add the image to the PDF
        pdf.addImage(imgData, 'PNG', 10, 10);

        // Save the PDF
        pdf.save('Reporte_de_inscripciones.pdf');
    });
}

// Behavior

$('#dashboard').on('shown.bs.collapse', function () {
    $('#courses').collapse('hide');
    $('#reports').collapse('hide');
    loadDashboardData();
});

$('#courses').on('shown.bs.collapse', function () {
    $('#dashboard').collapse('hide');
    $('#reports').collapse('hide');
    loadCourses();
});

$('#reports').on('shown.bs.collapse', function () {
    $('#dashboard').collapse('hide');
    $('#courses').collapse('hide');
    loadReportsData();
});

// BUTTONS

// "New Course" button
$('#newCourseBtn').click(function () {
    $('#newCourseModal').modal('show');
});

// "Cancel" new course button

$('#cancelNewCourse').click(function () {
    $('#newCourseForm').addClass('d-none');
});

// "Apply Filters" button
$('#applyFilters').click(function () {
    const filters = {
        name: $('#filterName').val(),
        category: $('#filterCategory').val(),
    };
    loadReportsData(filters);
});

// "Clear Filters" button
$('#clearFilters').click(function () {
    $('#filterCategory').val('');

    // Reload the data without filters
    loadReportsData({});
    $('#reports').collapse('show');
    $('#dashboard').collapse('hide');
    $('#courses').collapse('hide');
});

// "Export to PDF" button
$('#exportPdf').click(function () {
    // Implement export to PDF functionality here
});

// "Delete" Course button
$(document).on('click', '#btnDeleteCourse', function (e) {
    e.preventDefault();

    // Retrieve the courseId from the data-id attribute
    var id = $(this).data('id');

    // Pass the courseId to the deleteCourse function
    Swal.fire({
        title: "Seguro>",
        text: "Esta acción no se puede revertir",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Confirmar"
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: "Borrado!",
                text: "El curso ha sido borrado",
                icon: "success"
            });
            deleteCourse(id);
        }
    });
});

//Save new Course button
$('#newCourseForm').on('submit', function (event) {
    event.preventDefault();

    // Create a FormData object
    var formData = new FormData(this);

    // Get the file inputs
    var additionalImage1 = $('#additionalImage1')[0].files[0];
    var additionalImage2 = $('#additionalImage2')[0].files[0];

    // Convert images to Base64 and append to FormData
    if (additionalImage1) {
        convertImageToBase64(additionalImage1, function (base64Image1) {
            formData.append('additionalImage1', base64Image1);

            // Convert the second image
            if (additionalImage2) {
                convertImageToBase64(additionalImage2, function (base64Image2) {
                    formData.append('additionalImage2', base64Image2);

                    // Submit the form data via AJAX
                    submitFormData(formData);
                });
            } else {
                // If there's no second image, submit the form data
                submitFormData(formData);
            }
        });
    } else {
        // If there's no first image, just submit the form data
        submitFormData(formData);
    }
    CustomMsgBox('success', 'Curso Guardado', '', '')
    refreshCourses();
});

$("#exportPdf").click(function (e) { 
    e.preventDefault();
    exportTableToPDF();
});



