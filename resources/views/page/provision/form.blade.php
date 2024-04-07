<!DOCTYPE html>
<html>
<head>
    <title>Provision Server Form</title>
</head>
<body>
    <h1>Provision Server</h1>
    <form method="POST" action="{{ url('/provision-server') }}">
        @csrf
        <label for="server_name">Server Name:</label><br>
        <input type="text" id="server_name" name="server_name"><br>
        <label for="server_type">Server Type:</label><br>
        <input type="text" id="server_type" name="server_type"><br><br>
        <button type="submit">Provision Server</button>
    </form>
</body>
</html>
