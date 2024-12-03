<?php
// Sertakan file koneksi
include 'koneksi.php';

// Variabel untuk menyimpan pesan error
$error = '';

// Cek jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cegah SQL Injection
    $email = $conn->real_escape_string($email);

    // Query untuk mengambil user berdasarkan email
    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Ambil data user
        $user = $result->fetch_assoc();

        // Verifikasi password
        if ($password = $user['pass']) {
            // Login berhasil
            session_start();
            $_SESSION['user'] = $user;
            $_SESSION['login'] = true;
            header('Location: index.php'); // Arahkan ke halaman dashboard
            
        } else {
            // Password salah
            $error = "Password salah!";
        }
    } else {
        // User tidak ditemukan
        $error = "Email tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
    <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100 dark:bg-neutral-900">
        <div class="w-96 sm:w-[28rem] mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-neutral-900 dark:border-neutral-700">
            <div class="p-4 sm:p-7">
                <div class="text-center">
                    <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Sign in</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                        Don't have an account yet?
                        <a class="text-blue-600 decoration-2 hover:underline focus:outline-none focus:underline font-medium dark:text-blue-500" href="../examples/html/signup.html">
                            Sign up here
                        </a>
                    </p>
                </div>

                <div class="mt-5">
                    <button
                        type="button"
                        id="googleSignInButton"
                        class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
                        <svg
                            class="w-4 h-auto"
                            width="46"
                            height="47"
                            viewBox="0 0 46 47"
                            fill="none">
                            <path
                                d="M46 24.0287C46 22.09 45.8533 20.68 45.5013 19.2112H23.4694V27.9356H36.4069C36.1429 30.1094 34.7347 33.37 31.5957 35.5731L31.5663 35.8669L38.5191 41.2719L38.9885 41.3306C43.4477 37.2181 46 31.1669 46 24.0287Z"
                                fill="#4285F4" />
                            <path
                                d="M23.4694 47C29.8061 47 35.1161 44.9144 39.0179 41.3012L31.625 35.5437C29.6301 36.9244 26.9898 37.8937 23.4987 37.8937C17.2793 37.8937 12.0281 33.7812 10.1505 28.1412L9.88649 28.1706L2.61097 33.7812L2.52296 34.0456C6.36608 41.7125 14.287 47 23.4694 47Z"
                                fill="#34A853" />
                            <path
                                d="M10.1212 28.1413C9.62245 26.6725 9.32908 25.1156 9.32908 23.5C9.32908 21.8844 9.62245 20.3275 10.0918 18.8588V18.5356L2.75765 12.8369L2.52296 12.9544C0.909439 16.1269 0 19.7106 0 23.5C0 27.2894 0.909439 30.8731 2.49362 34.0456L10.1212 28.1413Z"
                                fill="#FBBC05" />
                            <path
                                d="M23.4694 9.07688C27.8699 9.07688 30.8622 10.9863 32.5344 12.5725L39.1645 6.11C35.0867 2.32063 29.8061 0 23.4694 0C14.287 0 6.36607 5.2875 2.49362 12.9544L10.0918 18.8588C11.9987 13.1894 17.25 9.07688 23.4694 9.07688Z"
                                fill="#EB4335" />
                        </svg>
                        Sign in with Google
                    </button>

                    <div class="py-3 flex items-center text-xs text-gray-400 uppercase before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">Or</div>

                    <!-- Form -->
                    <form method="POST" action="">
                        <div class="grid gap-y-4">
                            <!-- Form Group -->
                            <div>
                                <label for="email" class="block text-sm mb-2 dark:text-white">Email address</label>
                                <label class="input input-bordered flex items-center input-info gap-2 ">
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 16 16"
                                        fill="currentColor"
                                        class="h-4 w-4 opacity-70">
                                        <path
                                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                        <path
                                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                    </svg>
                                    <input
                                        type="email"
                                        class="grow"
                                        placeholder="Email"
                                        id="email"
                                        name="email"
                                        required aria-describedby="email-error" />
                                </label>
                                <p id="email-error" class="text-sm text-red-600 hidden">
                                    Please enter a valid email address.
                                </p>
                            </div>
                            <!-- End Form Group -->

                            <!-- Form Group -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <label for="password" class="block text-sm mb-2 dark:text-white">Password</label>
                                </div>
                                <div class="relative">
                                    <label class="input input-bordered flex items-center input-info gap-2">
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 16 16"
                                            fill="currentColor"
                                            class="h-4 w-4 opacity-70">
                                            <path
                                                fill-rule="evenodd"
                                                d="M14 6a4 4 0 0 1-4.899 3.899l-1.955 1.955a.5.5 0 0 1-.353.146H5v1.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-2.293a.5.5 0 0 1 .146-.353l3.955-3.955A4 4 0 1 1 14 6Zm-4-2a.75.75 0 0 0 0 1.5.5.5 0 0 1 .5.5.75.75 0 0 0 1.5 0 2 2 0 0 0-2-2Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <input
                                            type="password"
                                            name="password"
                                            id="password"
                                            class="grow"
                                            placeholder="******"
                                            required
                                            aria-describedby="password-error" />
                                    </label>
                                </div>
                                <p class="hidden text-xs text-red-600 mt-2" id="password-error">
                                    Password minimal 8 karakter
                                </p>
                            </div>
                            <!-- End Form Group -->

                            <!-- Checkbox -->
                            <div class="flex items-center">
                                <div class="flex">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="shrink-0 mt-0.5 border-gray-200 rounded text-blue-600 focus:ring-blue-500 dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800">
                                </div>
                                <div class="ms-3">
                                    <label for="remember-me" class="text-sm dark:text-white">Remember me</label>
                                </div>
                            </div>
                            <!-- End Checkbox -->

                            <button type="submit" class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Sign in</button>
                        </div>
                    </form>
                    <!-- End Form -->
                </div>
            </div>
        </div>
    </div>
    </container>
</body>
<script>
    const passwordInput = document.querySelector("#password");
    const errorText = document.querySelector("#password-error");

    passwordInput.addEventListener("input", () => {
        if (passwordInput.value.length < 8) {
            errorText.classList.remove("hidden"); // Tampilkan pesan error
        } else {
            errorText.classList.add("hidden"); // Sembunyikan pesan error
        }
    });

    // Client ID yang didapatkan dari Google Cloud Console
    const clientId = "YOUR_CLIENT_ID";

    // Inisialisasi Google Identity Services
    function handleCredentialResponse(response) {
        console.log("Encoded JWT ID token: " + response.credential);
        // Kirim token ke backend Anda untuk verifikasi dan login
    }

    // Tombol Sign-in
    window.onload = function() {
        google.accounts.id.initialize({
            client_id: clientId,
            callback: handleCredentialResponse,
        });

        google.accounts.id.renderButton(
            document.getElementById("googleSignInButton"), {
                theme: "outline",
                size: "large"
            } // Kustomisasi tampilan tombol
        );

        google.accounts.id.prompt(); // Memunculkan prompt akun
    };
</script>

</html>