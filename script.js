// Menu Padrao
document.addEventListener("DOMContentLoaded", () => {
    const navToggle = document.getElementById("nav-toggle");
    const appNav = document.getElementById("app-nav");

    navToggle.addEventListener("click", () => {
        appNav.classList.toggle("active");
    });
});




document.addEventListener("DOMContentLoaded", () => {
    const cameraFeed = document.getElementById("camera-feed");
    const captureButton = document.getElementById("capture-button");
    const saveButton = document.getElementById("save-button");
    const imagePreview = document.getElementById("captured-image");
    const locationInfo = document.getElementById("location");
    const captureTimeInfo = document.getElementById("capture-time");





    let stream;
    let capturedImageBlob; // Armazenar temporariamente a imagem capturada como Blob

    async function startCamera() {
        try {
            const constraints = { video: { facingMode: "environment" } };
            stream = await navigator.mediaDevices.getUserMedia(constraints);
            cameraFeed.srcObject = stream;
        } catch (error) {
            console.error("Erro ao iniciar a câmera:", error);
        }
    }

    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");

    captureButton.addEventListener("click", () => {
        context.drawImage(cameraFeed, 0, 0, canvas.width, canvas.height);
        canvas.toBlob(blob => {
            capturedImageBlob = blob;
            imagePreview.src = URL.createObjectURL(blob);
        }, "image/jpeg");

        // Exibir mensagem de sucesso como um alert
        alert("Imagem capturada com sucesso!");

        navigator.geolocation.getCurrentPosition(position => {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;
            locationInfo.textContent = `Localização: ${latitude}, ${longitude}`;

            const captureTime = new Date().toLocaleString();
            captureTimeInfo.textContent = `Capturado em: ${captureTime}`;
        }, error => {
            console.error("Erro ao obter geolocalização:", error);
        });

        // Restante do código...
    });
saveButton.addEventListener("click", () => {
    const location = locationInfo.textContent;
    const captureTime = captureTimeInfo.textContent;

    if (capturedImageBlob) {
        const fileName = `capture_${Date.now()}.jpeg`; // Gera um nome de arquivo único
        const formData = new FormData();
        formData.append("imageFile", capturedImageBlob, fileName);
        formData.append("imageName", fileName); // Adiciona o nome da imagem ao FormData
        formData.append("location", location);
        formData.append("captureTime", captureTime);

        fetch("save_captures.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(result => {
            console.log(result);
            alert("Captura salva com sucesso!"); // Exibe a mensagem de sucesso
        })
        .catch(error => {
            console.error("Erro ao enviar dados para o servidor:", error);
        });
    } else {
        console.log("Nenhuma imagem capturada para salvar.");
    }
});

    startCamera();
});
