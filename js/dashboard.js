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
                // Optionally, refresh the list or remove the deleted item from the UI
                loadCourses(); // Example function to reload the courses
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
        dataType: 'json', // Ensure jQuery parses the response as JSON
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
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error loading dashboard data:", textStatus, errorThrown);
            $('#coursesTable tbody').html('<tr><td colspan="8">Error loading data.</td></tr>');
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
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error("Error loading reports data:", textStatus, errorThrown);
            $('#reportsTable tbody').html('<tr><td colspan="7">Error loading data.</td></tr>');
        }
    });
}

function convertToBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.onloadend = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(file);
    });
}

// PAGE ACTIONS

// Collapse behavior
$('#dashboard').on('shown.bs.collapse', function () {
    $('#courses').collapse('hide');
    $('#reports').collapse('hide');
});

$('#courses').on('shown.bs.collapse', function () {
    $('#dashboard').collapse('hide');
    $('#reports').collapse('hide');
});

// BUTTONS

// New Course button

$('#newCourseBtn').click(function () {
    $('#newCourseModal').modal('show');
});

$("#newCourseForm").submit(function (e) {
// "Delete" Course button
$(document).on('click', '#btnDeleteCourse', function (e) {
    e.preventDefault();

    // Collect form data
    var formData = new FormData(this);

    // Process gallery images to base64
    var images = [];
    var files = $("#gallery")[0].files;
    for (var i = 0; i < files.length; i++) {
        var reader = new FileReader();
        reader.onload = function (e) {
            images.push(e.target.result);
        };
        reader.readAsDataURL(files[i]);
    }

    // Ensure all images are processed before sending the request
    reader.onloadend = function () {
        // Create a plain object with form data
        var data = {
            courseName: formData.get("courseName"),
            duration: formData.get("duration"),
            mode: formData.get("mode"),
            description: formData.get("description"),
            category: formData.get("category"),
            price: formData.get("price"),
            promoterName: formData.get("promoterName"),
            images: JSON.stringify(images) // Convert images array to JSON string
        };

        

        // Cancel new course button
        $('#cancelNewCourse').click(function () {
            $('#newCourseForm').addClass('d-none');
        });

        $('#reports').on('shown.bs.collapse', function () {
            $('#dashboard').collapse('hide');
            $('#courses').collapse('hide');
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

        // Export to PDF button
        $('#exportPdf').click(function () {
            // Implement export to PDF functionality here
        });

