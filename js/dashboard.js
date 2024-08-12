$(document).ready(function () {

    loadReportsData({});

    loadDashboardData();

    loadCourses();

});

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
                                ${course.img1}
                                <div class="card-body">
                                    <h5 class="card-title">${course.name}</h5>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-warning btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
            });
            $('#coursesCards').html(rows);

        },
        error: function (xhr, status, error) {
            console.error('Error loading courses data:', error);
            $('#coursesCards').html('<div class="alert alert-danger">Error loading courses data. Please try again later.</div>');
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

// Open the new course form
$('#newCourseBtn').on('click', function () {
    $('#newCourseModal').modal('show');
});

// Cancel new course
$('#cancelNewCourse').on('click', function () {
    $('#newCourseForm').addClass('d-none');
});

$('#reports').on('shown.bs.collapse', function () {
    $('#dashboard').collapse('hide');
    $('#courses').collapse('hide');
});

// "Apply Filters" button
$('#applyFilters').on('click', function () {
    const filters = {
        name: $('#filterName').val(),
        category: $('#filterCategory').val(),
    };
    loadReportsData(filters);
});

// "Clear Filters" button
$('#clearFilters').on('click', function () {
    $('#filterCategory').val('');

    // Reload the data without filters
    loadReportsData({});
    $('#reports').collapse('show');
    $('#dashboard').collapse('hide');
    $('#courses').collapse('hide');
});

// Export to PDF
$('#exportPdf').on('click', function () {
    // Implement export to PDF functionality here
});

// Handle form submission
$('#newCourseForm').on('submit', function (event) {
    event.preventDefault(); // Prevent the form from submitting the traditional way

    // Gather form data
    const formData = new FormData(this);

    // Convert images to Base64
    const files = $('#gallery')[0].files;
    const imagePromises = [];
    for (const file of files) {
        imagePromises.push(convertToBase64(file));
    }

    Promise.all(imagePromises).then(images => {
        formData.append('images', JSON.stringify(images));

        // Send data to server
        $.ajax({
            url: 'http://localhost:8080/addCourse', // Replace with your endpoint URL
            method: 'POST',
            data: formData,
            contentType: false, // Set contentType to false to use FormData
            processData: false, // Prevent jQuery from processing data
            success: function (response) {
                console.log('Course saved successfully:', response);
                $('#newCourseModal').modal('hide'); // Hide modal
                // Optionally, reload course list or update UI
            },
            error: function (xhr, status, error) {
                console.error('Error saving course:', error);
            }
        });
    });
});