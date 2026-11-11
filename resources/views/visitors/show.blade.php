
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Details</title>

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
            max-width: 650px;
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

        .detail {
            padding: 16px 0;
            border-bottom: 1px solid #edf0f5;
        }

        .detail:last-of-type {
            border-bottom: none;
        }

        .detail label {
            display: block;
            color: #718096;
            font-size: 13px;
            margin-bottom: 7px;
        }

        .detail p {
            margin: 0;
            font-size: 16px;
            font-weight: bold;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .buttons a {
            padding: 12px 18px;
            border-radius: 7px;
            text-decoration: none;
            font-size: 14px;
        }

        .back-btn {
            background: #e9edf5;
            color: #263248;
        }

        .edit-btn {
            background: #3157d5;
            color: white;
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
        <h1>Visitor Details</h1>
        <p class="subtitle">Complete information about this visitor.</p>

        <div class="detail">
            <label>Visitor ID</label>
            <p>{{ $visitor->id }}</p>
        </div>

        <div class="detail">
            <label>Full Name</label>
            <p>{{ $visitor->name }}</p>
        </div>

        <div class="detail">
            <label>Address</label>
            <p>{{ $visitor->address }}</p>
        </div>

        <div class="detail">
            <label>Position</label>
            <p>{{ $visitor->position }}</p>
        </div>

        <div class="detail">
            <label>Date Added</label>
            <p>{{ $visitor->created_at->format('F d, Y h:i A') }}</p>
        </div>

        <div class="buttons">
            <a href="{{ route('visitors.index') }}" class="back-btn">Back to List</a>

            <a href="{{ route('visitors.edit', $visitor->id) }}" class="edit-btn">Edit Visitor</a>
        </div>
    </div>
</div>
</body>
</html>
