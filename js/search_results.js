    $(document).ready(function() {
        $('#searchForm').submit(function(event) {
            event.preventDefault();

            let searchTerm = $('#searchInput').val();

            $.ajax({
                url: 'http://localhost:8080/buscarCursos',
                type: 'GET',
                dataType: 'json',
                data: {
                    search: searchTerm
                },
                success: function(data) {
                    let resultContainer = $('.container');
                    resultContainer.empty();

                    if (data.length > 0) {
                        let table = `
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Duration</th>
                                        <th>Modalidad</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Promotor</th>
                                        <th>Inscriptions</th>
                                    </tr>
                                </thead>
                                <tbody>
                        `;

                        $.each(data, function(index, course) {
                            table += `
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

                        table += `
                                </tbody>
                            </table>
                        `;

                        resultContainer.append(table);
                    } else {
                        resultContainer.append('<p>No courses found.</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                    $('.container').append('<p>An error occurred while retrieving the courses.</p>');
                }
            });
        });
    });
