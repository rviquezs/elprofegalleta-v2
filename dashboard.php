<?php include_once __DIR__ . "/shared/header.php" ?>

<div class="sidebar">
    <a href="#dashboard" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#dashboard">Dashboard</a>
    <a href="#courses" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#courses">Courses</a>
    <a href="#reports" class="sidebar-link" data-bs-toggle="collapse" data-bs-target="#reports">Reports</a>
</div>

<div class="content">
    <div id="dashboard" class="collapse show">
        <h2>Dashboard</h2>
        <table class="table table-striped table-bordered" id="coursesTable">
            <thead>
                <tr>
                    <th>Curso</th>
                    <th>Duracion</th>
                    <th>Modalidad</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Promotor</th>
                    <th>Inscripciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se insertarán aquí mediante jQuery/AJAX -->
            </tbody>
        </table>
    </div>

    <div id="courses" class="collapse">
        <h2>Courses</h2>
        <button class="btn btn-primary mb-3" id="newCourseBtn">New Course</button>
        <div id="coursesCards" class="row">
            <!-- AJAX -->
        </div>
        <!-- New Course -->
        <div class="modal fade" id="newCourseModal" tabindex="-1" aria-labelledby="newCourseModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newCourseModalLabel">Add New Course</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="newCourseForm">
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
                            <button type="submit" class="btn btn-primary">Save Course</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="reports" class="collapse">
        <h2>Reports</h2>
        <form id="filterForm" class="mb-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="filterCategory" class="form-label">Categoria</label>
                        <input type="text" class="form-control" id="filterCategory">
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" id="applyFilters">Apply Filters</button>
            <button id="clearFilters" class="btn btn-secondary">Clear Filters</button>
            <button type="button" class="btn btn-success" id="exportPdf">Export to PDF</button>
        </form>
        <table class="table table-striped table-bordered" id="reportsTable">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Duracion</th>
                    <th>Modalidad</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Promotor</th>
                    <th>Inscripciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- Los datos se insertarán aquí mediante jQuery -->
            </tbody>
        </table>
    </div>


</div>

<?php include_once __DIR__ . "/shared/footer.php" ?>