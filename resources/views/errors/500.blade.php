<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Facility ITB - Internal Server Error</title>
    <style>
    body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        text-align: center;
        font-family: 'Arial', sans-serif;
        background-color: #F5F7FC;
        margin: 0;
        padding: 0;
        flex-direction: column; /* Menambahkan flex-direction agar konten berada di tengah secara vertical */
    }

    .container {
        max-width: 600px;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    img {
        width: 500px;
        height: 500px;
    }

    p {
        font-size: 18px;
        color: #333;
    }

    a {
        text-decoration: none;
        color: #0066cc;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    /* Media queries untuk perangkat dengan lebar maksimal 600px */
    @media (max-width: 720px) {
        .container {
            padding: 10px;
        }

        img {
            width: 100%;
            height: auto;
        }
    }
</style>
</head>
<body>
    <div class="container">
        <br>
    <p>Maaf, terjadi kesalahan internal pada server.
        <br>Silakan coba lagi nanti, atau kembali ke <a href="http://e-facility.itb.ac.id/">Halaman Utama</a>.</p>
    <img src="{{ asset('media/images/error/500.jpg') }}" alt="Error 505" />
    </div>
</body>