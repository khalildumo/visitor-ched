
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Management System</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f4f6fb;
            padding: 35px 20px;
            color: #263248;
        }

        .container {
            max-width: 1100px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 7px;
        }

        .header p {
            color: #718096;
        }

        .add-btn {
            background: #3157d5;
            color: white;
            padding: 12px 18px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 18px rgba(0,0,0,0.05);
        }

        .success {
            background: #d9fbe5;
            color: #176b39;
            padding: 13px;
            border-radius: 7px;
            margin-bottom: 18px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 22px;
        }

        .search-form input {
            flex: 1;
            min-width: 0;
            padding: 12px;
            border: 1px solid #dce1eb;
            border-radius: 7px;
            font-size: 14px;
        }

        .search-btn, .reset-btn {
            border: none;
            padding: 12px 18px;
            border-radius: 7px;
            cursor: pointer;
            text-decoration: none;
            font-size: 14px;
        }

        .search-btn {
            background: #3157d5;
            color: white;
        }

        .reset-btn {
            background: #e9edf5;
            color: #263248;
        }

        .table-wrapper {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf0f5;
        }

        th {
            background: #f7f8fc;
            color: #596579;
            font-size: 13px;
            text-transform: uppercase;
        }

        td {
            font-size: 14px;
        }

        tr:hover {
            background: #fafbff;
        }

        .action a, .delete-btn {
            display: inline-block;
            padding: 7px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            margin: 2px;
        }

        .view {
            background: #e3edff;
            color: #2454b8;
        }

        .edit {
            background: #fff2d6;
            color: #9a6500;
        }

        .delete-btn {
            background: #ffe2e2;
            color: #c62828;
            border: none;
            cursor: pointer;
        }

       .pagination {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 7px;
    margin-top: 22px;
}

.pagination a,
.pagination span {
    display: inline-flex;
    justify-content: center;
    align-items: center;
    min-width: 36px;
    height: 36px;
    padding: 0 10px;
    border: 1px solid #dce1eb;
    border-radius: 6px;
    text-decoration: none;
    color: #3157d5;
    background: white;
    font-size: 14px;
}

.pagination span[aria-current="page"] {
    background: #3157d5;
    color: white;
    border-color: #3157d5;
}

.pagination a:hover {
    background: #e9edf5;
}

.pagination svg {
    display: none;
}

        .empty {
            text-align: center;
            padding: 30px;
            color: #718096;
        }

        @media (max-width: 600px) {
            body {
                padding: 20px 12px;
            }

            .header h1 {
                font-size: 23px;
            }

            .card {
                padding: 15px;
            }

            .search-form {
                flex-wrap: wrap;
            }

            .search-form input {
                flex-basis: 100%;
            }
        }
    </style>
</head>

<body>
<div class="container">

    <div class="header">
        <div>
            <h1>Visitor Management System</h1>
            <p>Manage and monitor visitor records</p>
        </div>

        <a href="{{ route('visitors.create') }}" class="add-btn">
            + Add New Visitor
        </a>
    </div>

    <div class="card">

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('visitors.index') }}" method="GET" class="search-form">
            <input
                type="text"
                name="search"
                placeholder="Search name, address, or position..."
                value="{{ $search ?? '' }}"
            >

            <button type="submit" class="search-btn">Search</button>

            <a href="{{ route('visitors.index') }}" class="reset-btn">Reset</a>
        </form>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($visitors as $visitor)
                        <tr>
                            <td>{{ $visitor->id }}</td>
                            <td>{{ $visitor->name }}</td>
                            <td>{{ $visitor->address }}</td>
                            <td>{{ $visitor->position }}</td>
                            <td>{{ $visitor->created_at->format('M d, Y') }}</td>

                            <td class="action">
                                <a href="{{ route('visitors.show', $visitor->id) }}" class="view">View</a>

                                <a href="{{ route('visitors.edit', $visitor->id) }}" class="edit">Edit</a>

                                <form action="{{ route('visitors.destroy', $visitor->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Are you sure you want to delete this visitor?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="empty">
                                No visitor records found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

   @if ($visitors->total() > 0)
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; flex-wrap: wrap; gap: 12px;">

        <div style="color: #718096; font-size: 14px;">
            Showing
            <strong>{{ $visitors->firstItem() }}</strong>
            to
            <strong>{{ $visitors->lastItem() }}</strong>
            of
            <strong>{{ $visitors->total() }}</strong>
            results
        </div>
        

        @if ($visitors->hasPages())
            <div class="pagination">
                @foreach ($visitors->getUrlRange(1, $visitors->lastPage()) as $page => $url)
                    @if ($page == $visitors->currentPage())
                        <span aria-current="page">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            </div>
        @endif

    </div>
@endif
    </div>
</div>
</body>
</html>
