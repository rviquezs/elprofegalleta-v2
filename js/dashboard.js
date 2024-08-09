$(document).ready(function () {
    // Function to handle the collapse behavior
    $('#dashboard').on('shown.bs.collapse', function () {
        $('#courses').collapse('hide');
        $('#reports').collapse('hide');
    });

    $('#courses').on('shown.bs.collapse', function () {
        $('#dashboard').collapse('hide');
        $('#reports').collapse('hide');
    });

    // Function to open the new course modal
    $('#newCourseBtn').on('click', function () {
        $('#newCourseModal').modal('show');
    });

    // Function to cancel adding a new course
    $('#cancelNewCourse').on('click', function () {
        $('#newCourseForm').addClass('d-none');
    });

    $('#reports').on('shown.bs.collapse', function () {
        $('#dashboard').collapse('hide');
        $('#courses').collapse('hide');
    });

    // Function to load data into the dashboard table
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
                                <td>${course.promoter}</td>
                                <td>${course.inscriptions}</td>
                                <td>${course.last_updated}</td>
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

    // Function to load data into the reports table based on filters
    function loadReportsData(filters) {
        $.ajax({
            url: 'http://localhost:8080/filtrarCursos', // Replace with your endpoint URL for filtered data
            method: 'GET',
            data: filters,
            dataType: 'json', // Ensure jQuery parses the response as JSON
            success: function (data) {
                console.log("Filtered data received:", data); // Debugging line to check the data
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
                                <td>${course.promoter}</td>
                                <td>${course.inscriptions}</td>
                                <td>${course.last_updated}</td>
                            </tr>
                        `;
                });
                $('#reportsTable tbody').html(rows);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error("Error loading reports data:", textStatus, errorThrown);
                $('#reportsTable tbody').html('<tr><td colspan="11">Error loading data.</td></tr>');
            }
        });
    }

    // Load dashboard data on page load
    loadDashboardData();

    // Load reports data on page load
    loadReportsData({}); // Initial load with no filters

    // Apply filters and load reports data
    $('#applyFilters').on('click', function () {
        const filters = {
            name: $('#filterName').val(),
            category: $('#filterCategory').val(),
            priceMin: $('#filterPriceMin').val(),
            priceMax: $('#filterPriceMax').val()
        };
        loadReportsData(filters);
    });

    // Export to PDF functionality
    $('#exportPdf').on('click', function () {
        // Implement export to PDF functionality here
    });

    // Function to load courses data into the coursesList
    function loadCourses() {
        $.ajax({
            url: 'http://localhost:8080/obtenerTodosCursos', // Replace with your endpoint URL
            method: 'GET',
            dataType: 'json', // Ensure jQuery parses the response as JSON
            success: function (data) {
                // Ensure data is an array before proceeding
                if (Array.isArray(data)) {
                    let rows = '';
                    data.forEach(course => {
                        rows += `
                            <div class="col-md-4 mb-4">
                                <div class="card course-card">
                                    <div id="courseCarousel${course.id}" class="carousel slide">
                                        <div class="carousel-inner">
                                            ${course.images.map((img, index) => `
                                                <div class="carousel-item ${index === 0 ? 'active' : ''}">
                                                    <img src="${img}" class="d-block w-100" alt="Course Image ${index + 1}">
                                                </div>
                                            `).join('')}
                                        </div>
                                        <a class="carousel-control-prev" href="#courseCarousel${course.id}" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#courseCarousel${course.id}" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">${course.name}</h5>
                                        <p class="card-text">${course.description}</p>
                                        <div class="card-actions">
                                            <button class="btn btn-warning btn-sm">Edit</button>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    });
                    $('#coursesList').html(rows);
                } else {
                    console.error('Expected an array but received:', data);
                    $('#coursesList').html('<div class="alert alert-danger">Failed to load courses. Please try again later.</div>');
                }
            },
            error: function (xhr, status, error) {
                console.error('Error loading courses data:', error);
                $('#coursesList').html('<div class="alert alert-danger">Error loading courses data. Please try again later.</div>');
            }
        });
    }


    // Load courses data on page load
    loadCourses();

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

    // Function to convert file to Base64
    function convertToBase64(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onloadend = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(file);
        });
    }


});
