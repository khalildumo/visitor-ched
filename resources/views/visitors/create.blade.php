
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Visitor</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            padding: 35px 15px;
            background: #f4f6fb;
            color: #263248;
        }

        .container {
            max-width: 600px;
            margin: auto;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
        }

        h1 {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #718096;
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 13px;
            margin-bottom: 20px;
            border: 1px solid #dce1eb;
            border-radius: 7px;
            font-size: 14px;
        }

        input:focus {
            outline: none;
            border-color: #3157d5;
        }

        .error {
            color: #c62828;
            font-size: 13px;
            margin-top: -14px;
            margin-bottom: 15px;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 5px;
        }

        button, .back-btn {
            padding: 12px 18px;
            border: none;
            border-radius: 7px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }

        button {
            background: #3157d5;
            color: white;
        }

        .back-btn {
            background: #e9edf5;
            color: #263248;
        }

        @media(max-width: 500px) {
            .card {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
<div class="container">
    <div class="card">
        <h1>Add New Visitor</h1>
        <p class="subtitle">Enter the visitor's information below.</p>

        <form action="{{ route('visitors.store') }}" method="POST">
            @csrf

            <label for="name">Full Name</label>
            <input
                type="text"
                id="name"
                name="name"
                placeholder="Enter full name"
                value="{{ old('name') }}"
            >
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="address">Address</label>
            <input
                type="text"
                id="address"
                name="address"
                placeholder="Enter address"
                value="{{ old('address') }}"
            >
            @error('address')
                <div class="error">{{ $message }}</div>
            @enderror

            <label for="position">Position</label>
            <input
                type="text"
                id="position"
                name="position"
                placeholder="Enter position"
                value="{{ old('position') }}"
            >
            @error('position')
                <div class="error">{{ $message }}</div>
            @enderror

            <div class="buttons">
                <button type="submit">Save Visitor</button>
                <a href="{{ route('visitors.index') }}" class="back-btn">Back</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
