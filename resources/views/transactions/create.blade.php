<!DOCTYPE html>
<html>
<head>
    <title>Naujas įrašas</title>
</head>
<body>
    <h1>Naujas įrašas</h1>
    <form method="POST" action="/transactions">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="number" step="0.01" name="amount" placeholder="Suma" required>
        <textarea name="description" placeholder="Aprašymas"></textarea>
        <select name="category_id">
            <!-- You'll need to provide the categories data somehow in pure HTML -->
            <!-- Example static option: -->
            <option value="1">Category 1</option>
            <option value="2">Category 2</option>
        </select>
        <input type="date" name="date" required>
        <button type="submit">Išsaugoti</button>
    </form>
</body>
</html>