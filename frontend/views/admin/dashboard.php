<?php include "shared/header.php"; ?>

<div class="sidebar">
    <a href="#dashboard" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#dashboard">Dashboard</a>
    <a href="#courses" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#courses">Courses</a>
    <a href="#reports" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#reports">Reports</a>
</div>

<div class="content">
    <div id="dashboard" class="collapse show">
        <h2>Dashboard</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Total Inscriptions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Course 1</td>
                    <td>50</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Course 2</td>
                    <td>30</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div id="courses" class="collapse">
        <h2>Courses</h2>
        <button class="btn btn-primary mb-3" id="newCourseBtn">New Course</button>
        <div id="coursesList" class="row">
            <!-- Example course card -->
            <div class="col-md-4">
                <div class="card course-card">
                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Course Image">
                    <div class="card-body">
                        <h5 class="card-title">Course 1</h5>
                        <p class="card-text">Description of Course 1.</p>
                        <div class="card-actions">
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add more course cards here -->
        </div>
        <div id="newCourseForm" class="d-none">
            <h3>Add New Course</h3>
            <form>
                <div class="mb-3">
                    <label for="gallery" class="form-label">Gallery</label>
                    <input type="file" class="form-control" id="gallery" multiple>
                </div>
                <div class="mb-3">
                    <label for="courseName" class="form-label">Course Name</label>
                    <input type="text" class="form-control" id="courseName" required>
                </div>
                <div class="mb-3">
                    <label for="duration" class="form-label">Duration</label>
                    <input type="text" class="form-control" id="duration" required>
                </div>
                <div class="mb-3">
                    <label for="mode" class="form-label">Mode</label>
                    <input type="text" class="form-control" id="mode" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <input type="text" class="form-control" id="category" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" required>
                </div>
                <div class="mb-3">
                    <label for="promoterName" class="form-label">Promoter Name</label>
                    <input type="text" class="form-control" id="promoterName" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="tel" class="form-control" id="phone" required>
                </div>
                <div class="mb-3">
                    <label for="whatsapp" class="form-label">WhatsApp</label>
                    <input type="tel" class="form-control" id="whatsapp">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Course</button>
                <button type="button" class="btn btn-secondary" id="cancelNewCourse">Cancel</button>
            </form>
        </div>
    </div>

    <div id="reports" class="collapse">
        <h2>Reports</h2>
        <form id="filterForm" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="filterName" class="form-label">Course Name</label>
                        <input type="text" class="form-control" id="filterName">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="filterCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="filterCategory">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="filterPriceMin" class="form-label">Price Min</label>
                        <input type="number" class="form-control" id="filterPriceMin">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="filterPriceMax" class="form-label">Price Max</label>
                        <input type="number" class="form-control" id="filterPriceMax">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button>
            <button type="button" class="btn btn-success" id="exportPdf">Export to PDF</button>
        </form>
        <table class="table" id="reportTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Course Name</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Promoter</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Course 1</td>
                    <td>Description of Course 1</td>
                    <td>Category 1</td>
                    <td>$200</td>
                    <td>John Doe</td>
                </tr>
                <!-- Add more rows here -->
            </tbody>
        </table>
    </div>

</div>

<?php include "shared/footer.php"; ?>