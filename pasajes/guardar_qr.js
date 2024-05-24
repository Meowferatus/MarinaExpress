document.getElementById('QRcode').addEventListener('click', function() {
    const token = uuid.v4(); 

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_qr.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Código QR guardado en la base de datos.');
            } else {
                console.error('Error al guardar el código QR en la base de datos.');
            }
        }
    };
    xhr.send('token=' + encodeURIComponent(token));
});
document.getElementById('QRcode').addEventListener('click', function() {
   
    const token = uuid.v4();
    console.log('Token generado:', token);


    const qrContainer = document.getElementById('qrcode');
    qrContainer.innerHTML = '';

    const qrcode = new QRCode(qrContainer, {
        text: token,
        width: 128,
        height: 128,
    });

    
    document.getElementById('qrpdfcode').style.display = 'inline-block';
    document.getElementById('qrpdfcode').setAttribute('data-token', token);
});

document.getElementById('qrpdfcode').addEventListener('click', function() {
    const token = this.getAttribute('data-token');
    if (!token) {
        console.error('No se ha generado un código QR.');
        return;
    }

    
    const qrCanvas = document.querySelector('#qrcode canvas');
    if (!qrCanvas) {
        console.error('No se ha generado un código QR.');
        return;
    }
    const imgData = qrCanvas.toDataURL('image/png');
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();
    // Se añade  título
    doc.setFontSize(18);
    doc.text('Código QR ', 10, 10);
    // Se añade la imagen del QR al PDF
    doc.addImage(imgData, 'PNG', 10, 20, 50, 50);
    // Se añade detalles adicionales
    doc.setFontSize(12);
    doc.text('Fecha de Generación:', 10, 100);
    doc.text(new Date().toLocaleString(), 10, 110);
    doc.save('Codigo QR.pdf');
});