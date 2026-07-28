<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (!window.jspdf || !window.jspdf.jsPDF) {
            console.error('jsPDF failed to load.');
            return;
        }

        const { jsPDF } = window.jspdf;

        // Convert local image to base64 for embedding in PDF
        function getImageBase64(url, callback) {
            const img = new Image();
            img.crossOrigin = 'Anonymous';
            img.onload = function () {
                const canvas = document.createElement('canvas');
                canvas.width = img.naturalWidth;
                canvas.height = img.naturalHeight;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0);
                callback(canvas.toDataURL('image/png'));
            };
            img.onerror = function () { callback(null); };
            img.src = url;
        }

        function createCertificatePdf(data, bgBase64, logoBase64) {
            const doc = new jsPDF({ orientation: 'landscape', unit: 'pt', format: 'a4' });
            const W = doc.internal.pageSize.getWidth();   // ~841.89
            const H = doc.internal.pageSize.getHeight();  // ~595.28

            // ── BACKGROUND ────────────────────────────────────────────
            if (bgBase64) {
                doc.addImage(bgBase64, 'PNG', 0, 0, W, H);
            } else {
                doc.setFillColor(4, 20, 36);
                doc.rect(0, 0, W, H, 'F');
            }

            // ── DARK OVERLAY (semi-transparent feel via layered rects) ─
            doc.setFillColor(2, 14, 26);
            doc.setGState(doc.GState({ opacity: 0.45 }));
            doc.rect(0, 0, W, H, 'F');
            doc.setGState(doc.GState({ opacity: 1.0 }));

            // ── GOLD BORDER ────────────────────────────────────────────
            const bw = 10, bp = 20;
            doc.setDrawColor(118, 189, 16);   // rich gold
            doc.setLineWidth(bw);
            doc.rect(bp, bp, W - bp * 2, H - bp * 2, 'S');

            // inner thin line
            doc.setDrawColor(118, 189, 16);
            doc.setLineWidth(1.5);
            doc.rect(bp + 16, bp + 16, W - (bp + 16) * 2, H - (bp + 16) * 2, 'S');

            // ── TOP ACCENT BAR ─────────────────────────────────────────
            doc.setFillColor(118, 189, 16);
            doc.rect(bp + 16, bp + 16, W - (bp + 16) * 2, 6, 'F');


            // ── BRAND HEADER (top center) ──────────────────────────────
            doc.setFontSize(28);
            doc.setFont('helvetica', 'bold');
            doc.setCharSpace(0);

            const cyberText = "CYBER ";
            const bdText = "BD";
            const cyberW = doc.getTextWidth(cyberText);
            const bdW = doc.getTextWidth(bdText);
            const totalBrandW = cyberW + bdW;
            const brandStartX = W / 2 - totalBrandW / 2;

            // Draw "CYBER " in White
            doc.setTextColor(255, 255, 255);
            doc.text(cyberText, brandStartX, 75);

            // Draw "BD" in Green (#76bd10)
            doc.setTextColor(118, 189, 16);
            doc.text(bdText, brandStartX + cyberW, 75);


            // ── MAIN TITLE ─────────────────────────────────────────────
            doc.setFontSize(46);
            doc.setFont('times', 'bolditalic');
            doc.setTextColor(255, 255, 255);
            doc.text('Certificate of Completion', W / 2, 132, { align: 'center' });

            // underline decoration
            const titleW = 370;
            doc.setDrawColor(118, 189, 16);
            doc.setLineWidth(1.5);
            doc.line(W / 2 - titleW / 2, 140, W / 2 + titleW / 2, 140);

            // ── "THIS IS TO CERTIFY THAT" ──────────────────────────────
            doc.setFontSize(13);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(180, 205, 230);
            doc.text('This is to certify that', W / 2, 175, { align: 'center' });

            // ── STUDENT NAME ───────────────────────────────────────────
            doc.setFontSize(38);
            doc.setFont('times', 'bolditalic');
            doc.setTextColor(118, 189, 16);
            doc.text(data.userName, W / 2, 222, { align: 'center' });

            // name underline
            doc.setDrawColor(118, 189, 16);
            doc.setLineWidth(0.8);
            const nameW = doc.getTextWidth(data.userName);
            doc.line(W / 2 - nameW / 2 - 10, 228, W / 2 + nameW / 2 + 10, 228);

            // ── BODY TEXT ──────────────────────────────────────────────
            doc.setFontSize(13);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(180, 205, 230);
            doc.text('has successfully completed the course', W / 2, 260, { align: 'center' });

            // ── COURSE NAME ────────────────────────────────────────────
            doc.setFontSize(26);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(255, 255, 255);
            doc.text(data.courseName, W / 2, 298, { align: 'center' });

            // ── DECORATIVE DIVIDER ─────────────────────────────────────
            const divY = 322;
            doc.setDrawColor(118, 189, 16);
            doc.setLineWidth(0.8);
            doc.line(140, divY, W / 2 - 30, divY);
            // diamond
            doc.setFillColor(118, 189, 16);
            doc.circle(W / 2, divY, 4, 'F');
            doc.line(W / 2 + 30, divY, W - 140, divY);

            // ── CERT NUMBER & DATE ROW ─────────────────────────────────
            doc.setFontSize(11);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(140, 170, 200);

            doc.text('CERTIFICATE NO.', 148, 358);
            doc.setFontSize(13);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(118, 189, 16);
            doc.text(data.certificateNumber, 148, 375);

            doc.setFontSize(11);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(140, 170, 200);
            doc.text('DATE OF ISSUE', W - 148, 358, { align: 'right' });
            doc.setFontSize(13);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(118, 189, 16);
            doc.text(data.issuedDate, W - 148, 375, { align: 'right' });

            // ── SIGNATURE SECTION ──────────────────────────────────────
            const sigY1 = 440, sigY2 = sigY1 + 14, sigY3 = sigY1 + 30;

            // Left signature
            doc.setDrawColor(118, 189, 16);
            doc.setLineWidth(0.8);
            doc.line(130, sigY1, 300, sigY1);
            doc.setFontSize(13);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(255, 255, 255);
            doc.text('Authorized Signature', 215, sigY2, { align: 'center' });
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(140, 170, 200);
            doc.text('Director of Education', 215, sigY3, { align: 'center' });

            // Right signature
            doc.setDrawColor(118, 189, 16);
            doc.line(W - 300, sigY1, W - 130, sigY1);
            doc.setFontSize(13);
            doc.setFont('helvetica', 'bold');
            doc.setTextColor(255, 255, 255);
            doc.text('Program Director', W - 215, sigY2, { align: 'center' });
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(140, 170, 200);
            doc.text('Academic Affairs', W - 215, sigY3, { align: 'center' });



            // ── BOTTOM ACCENT BAR ──────────────────────────────────────
            doc.setFillColor(118, 189, 16);
            doc.rect(bp + 16, H - bp - 22, W - (bp + 16) * 2, 6, 'F');

            // ── VERIFICATION TEXT ──────────────────────────────────────
            doc.setFontSize(9);
            doc.setFont('helvetica', 'normal');
            doc.setTextColor(100, 130, 160);
            const footerText = (data.companyName || 'CYBER BD') + '  |  ' + data.certificateNumber;
            doc.text(footerText, W / 2, H - bp - 28, { align: 'center' });

            return doc;
        }

        function handleCertificateDownload(event) {
            const button = event.currentTarget;
            const originalHtml = button.innerHTML;
            button.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Generating...';
            button.disabled = true;

            const certData = {
                certificateNumber: button.dataset.certificateNumber || 'CERT-0000000000',
                courseName: button.dataset.courseName || 'Course Name',
                userName: button.dataset.userName || 'Student Name',
                issuedDate: button.dataset.issuedDate || new Date().toLocaleDateString(),
                companyName: button.dataset.companyName || '{{ $companyName ?? "" }}',
            };

            const bgUrl = '{{ asset("certificate.png") }}';

            getImageBase64(bgUrl, function (bgBase64) {
                const pdf = createCertificatePdf(certData, bgBase64);
                const fileName = `${certData.courseName.replace(/[^a-z0-9]/gi, '_').toLowerCase()}_${certData.certificateNumber}.pdf`;
                pdf.save(fileName);
                button.innerHTML = originalHtml;
                button.disabled = false;
            });
        }

        document.querySelectorAll('.certificate-download-btn').forEach(button => {
            button.addEventListener('click', handleCertificateDownload);
        });
    });
</script>
