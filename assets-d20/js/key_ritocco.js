

/* KEY CUT 4/3 ORIZZONATALE */
document.addEventListener('keydown', function (event) {
    if (event.code == 'KeyC') {

        var selectDaVerificare = document.getElementById('ratio');
        var indiceSelezionato = selectDaVerificare.selectedIndex;
        var valoreSelezionato = selectDaVerificare.options[indiceSelezionato];
        var ratio = valoreSelezionato.value;

        document.getElementById("cropImageBtn").className += "btn btn-danger"; //prima faccio cambiare colore al bottone di conferma
        var image = document.getElementById('image');
        var cropper = new Cropper(image, {

            aspectRatio: 8 / 6.05,
            viewMode: 0,
        });
        document.addEventListener('keydown', function (event) {
            if (event.code == 'KeyX') {

                croppedImage = cropper.getCroppedCanvas().toDataURL("image/jpg");
                document.getElementById('output').src = croppedImage;

                document.getElementById('textImg').innerHTML += croppedImage;
                document.getElementById("cropImageBtn").className += "btn btn-success"; //poi lo faccio diventare verde a ritaglio avvenuto
            }
            });
        

    }
});


/* KEY CUT 4/3 VERTICALE */
document.addEventListener('keydown', function (event) {
    if (event.code == 'KeyV') {

        var selectDaVerificare = document.getElementById('ratio');
        var indiceSelezionato = selectDaVerificare.selectedIndex;
        var valoreSelezionato = selectDaVerificare.options[indiceSelezionato];
        var ratio = valoreSelezionato.value;

        document.getElementById("cropImageBtn").className += "btn btn-danger"; //prima faccio cambiare colore al bottone di conferma
        var image = document.getElementById('image');
        var cropper = new Cropper(image, {

            aspectRatio: 6 / 7.9,
            viewMode: 0,

        });
        document.addEventListener('keydown', function (event) {
            if (event.code == 'KeyX') {

                croppedImage = cropper.getCroppedCanvas().toDataURL("image/jpg");
                document.getElementById('output').src = croppedImage;

                document.getElementById('textImg').innerHTML += croppedImage;
                document.getElementById("cropImageBtn").className += "btn btn-success";//poi lo faccio diventare verde a ritaglio avvenuto
            }
            });
        

    }
});







