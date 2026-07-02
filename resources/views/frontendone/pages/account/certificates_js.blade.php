<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (!window.jspdf || !window.jspdf.jsPDF) {
            console.error('jsPDF failed to load.');
            return;
        }

        const { jsPDF } = window.jspdf;

        function createCertificatePdf(data) {
            const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'a4' });
            const width = doc.internal.pageSize.getWidth();
            const height = doc.internal.pageSize.getHeight();

            // Background
            doc.setFillColor('#08192b');
            doc.rect(0, 0, width, height, 'F');

            // Outer border
            doc.setDrawColor('#7cc576');
            doc.setLineWidth(10);
            doc.rect(24, 24, width - 48, height - 48, 'S');

            // Inner gradient-style block
            doc.setFillColor('#0f2b4d');
            doc.roundedRect(48, 48, width - 96, height - 96, 18, 18, 'F');

            // Title
            doc.setFontSize(40);
            doc.setTextColor('#ffffff');
            doc.setFont('helvetica', 'bold');
            doc.text('Certificate of Completion', width / 2, 140, { align: 'center' });

            // Subtitle
            doc.setFontSize(18);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor('#c1d4f0');
            doc.text('This is to certify that', width / 2, 190, { align: 'center' });

            // Student name
            doc.setFontSize(32);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor('#ffffff');
            doc.text(data.userName, width / 2, 245, { align: 'center' });

            // Statement block
            doc.setFontSize(18);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor('#c1d4f0');
            const statement = `has successfully completed the course`;
            doc.text(statement, width / 2, 290, { align: 'center' });

            // Course name
            doc.setFontSize(28);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor('#ffffff');
            doc.text(data.courseName, width / 2, 330, { align: 'center' });

            // Divider
            doc.setDrawColor('#5070c0');
            doc.setLineWidth(2);
            doc.line(120, 360, width - 120, 360);

            // Certificate number + issue date
            doc.setFontSize(14);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor('#b8c7df');
            doc.text(`Certificate No: ${data.certificateNumber}`, 120, 410);
            doc.text(`Issued: ${data.issuedDate}`, width - 120, 410, { align: 'right' });

            // Signature area
            doc.setFontSize(16);
            doc.setTextColor('#ffffff');
            doc.text('Authorized Signature', 140, height - 110);
            doc.setLineWidth(1);
            doc.line(140, height - 100, 320, height - 100);

            doc.setFontSize(16);
            doc.text('Director of Education', 140, height - 80);

            // Seal circle
            doc.setFillColor('#7cc576');
            doc.circle(width - 140, height - 130, 48, 'F');
            doc.setFontSize(10);
            doc.setTextColor('#08192b');
            doc.text('CERTIFIED', width - 140, height - 143, { align: 'center' });
            doc.text('WITH EXCELLENCE', width - 140, height - 130, { align: 'center' });

            return doc;
        }

        function handleCertificateDownload(event) {
            const button = event.currentTarget;
            const certificateData = {
                certificateNumber: button.dataset.certificateNumber || 'CERT-0000000000',
                courseName: button.dataset.courseName || 'Course Name',
                userName: button.dataset.userName || 'Student Name',
                issuedDate: button.dataset.issuedDate || new Date().toLocaleDateString(),
            };

            const pdf = createCertificatePdf(certificateData);
            const fileName = `${certificateData.courseName.replace(/[^a-z0-9]/gi, '_').toLowerCase()}_${certificateData.certificateNumber}.pdf`;
            pdf.save(fileName);
        }

        document.querySelectorAll('.certificate-download-btn').forEach(button => {
            button.addEventListener('click', handleCertificateDownload);
        });
    });
</script>
