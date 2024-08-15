<?php include "shared/header.php"; ?>

<main>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <?php
                if (isset($_GET['id'])) {
                    $courseId = $_GET['id'];

                    $conn = new mysqli('localhost', 'root', '', 'elprofegalleta');

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT * FROM cursos WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $courseId);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $row = $result->fetch_assoc(); 
                        echo "<h2>" . htmlspecialchars($row["name"]) . "</h2>";
                        
                        echo "<div class='course-details'>";
                        echo "<div class='details-card'>";
                        echo "<p><strong>Duración:</strong> " . htmlspecialchars($row["duration"]) . " semanas</p>";
                        echo "<p><strong>Modalidad:</strong> " . htmlspecialchars($row["modalidad"]) . "</p>";
                        echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row["category"]) . "</p>";
                        echo "<p><strong>Precio:</strong> $" . htmlspecialchars($row["price"]) . " USD</p>";
                        echo "<p><strong>Promotor:</strong> " . htmlspecialchars($row["promoter"]) . "</p>";
                        echo "<img src='" . htmlspecialchars($row["img1"]) . "' alt='" . htmlspecialchars($row["name"]) . "' class='flag-img' />";
                        echo "</div>";
                        echo "</div>";
                    } else {
                        echo "<div class='alert alert-danger'>No se encontró el curso solicitado.</div>";
                    }

                    $stmt->close();
                    $conn->close();
                } else {
                    echo "<div class='alert alert-danger'>No se proporcionó un ID de curso.</div>";
                }
                ?>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <?php
                    if (isset($row)) {
                        echo "<img src='" . htmlspecialchars($row["img1"]) . "' class='card-img-top' alt='" . htmlspecialchars($row["name"]) . "' />";
                        echo "<div class='card-body'>";
                        echo "<h5 class='card-title'>" . htmlspecialchars($row["name"]) . "</h5>";
                        echo "<p class='card-text'>Precio: $" . htmlspecialchars($row["price"]) . " USD</p>";
                        echo "<a href='#' class='btn btn-primary'>Inscribirse</a>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "shared/footer.php"; ?>


