<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SMART Operasional Web</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-cover bg-center bg-no-repeat h-screen flex items-center justify-center" style="background-image: url('https://www.smart-tbk.com/wp-content/uploads/2022/09/33488882768_ed6364a89f_k.jpg');">
    <div class="bg-white/80 backdrop-blur-md p-10 rounded-xl shadow-xl w-full max-w-md">
        <div class="flex justify-center mb-8">
            <img src="https://karirlab-prod-bucket.s3.ap-southeast-1.amazonaws.com/files/privates/eOKUYBxRLTNuKfC8t7Y0WfkcD1E1L2kMi5linl1V.png" alt="SMART Operasional Web Logo" class="w-32 h-auto">
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Login Option</h1>
        <div class="space-y-4">
            <a href="/employee/login" class="block">
                <button class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-lg shadow-lg transition duration-300">
                    Login Employee
                </button>
            </a>
            <a href="/admin/login" class="block">
                <button class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg shadow-lg transition duration-300">
                    Login Admin
                </button>
            </a>
        </div>
    </div>
</body>
</html>
