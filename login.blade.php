<html>
    <head>
        <title>Login MyFlorist</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-purple-50 flex items-center justify-center h-screen">
        <div class="bg-white p-6 rounded-2xl shadow-xl w-80 border border-purple-100">
            <h2 class="text-2xl font-bold mb-6 text-center text-purple-900">Login MyFlorist</h2>
            
                <form action="{{ route('login.process') }}" method="post">
                    @csrf
                    <label for="email" class="text-xs font-semibold text-gray-600 uppercase block mb-1">Email</label>
                    <input type="email" name="email" class="w-full border border-gray-300 p-2.5 mb-4 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition text-sm" required>

                    <label for="password" class="text-xs font-semibold text-gray-600 uppercase block mb-1">Password</label>
                    <input type="password" name="password" class="w-full border border-gray-300 p-2.5 mb-5 rounded-2xl focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500 transition text-sm" required>

                    <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white w-full py-2.5 rounded-2xl font-semibold transition shadow-sm">Login</button>
                </form>
                
                @error('login_error')
                <p class="text-rose-500 text-sm mt-3 text-center font-medium">{{ $message }}</p>
                @enderror
        </div>
    </body>
</html>