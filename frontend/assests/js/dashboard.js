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
    
    $('#reports').on('shown.bs.collapse', function () {
        $('#dashboard').collapse('hide');
        $('#courses').collapse('hide');
    });

    // Export to PDF functionality
    $('#exportPdf').on('click', function () {
        var doc = new jsPDF();
        html2canvas($('#reportTable')[0]).then(function(canvas) {
            var imgData = canvas.toDataURL('image/png');
            var imgWidth = 210; // A4 width in mm
            var pageHeight = 295; // A4 height in mm
            var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;
            
            var position = 0;

            doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;
            
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                doc.addPage();
                doc.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }
            
            doc.save('courses-report.pdf');
        });
    });
});
