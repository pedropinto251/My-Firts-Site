<?php
include_once __DIR__ . "/../../common/ConnectionBD1.php";
include_once "../layouts/header.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sua Página</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .main-content {
            flex-grow: 1; 
            display: flex;
            justify-content: center;
            align-items: center;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px;
            position: fixed;
            bottom: 0; 
            width: 100%; 
        }
    </style>
</head>
<body>

<?php
class ProjetoAction
{
    private $db;

    public function __construct()
    {
        $this->db = new ConnectionBD1;
    }

    public function getProjectsList()
    {
        $projects = array();

        $this->db->createConnection();

        $sql = "SELECT Id_projeto, AlunoID, Projeto, DataSubmissao, PDF FROM Projeto";
        $result = $this->db->executeQuery($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $projects[$row["Id_projeto"]] = $row;
            }
        }

        $this->db->closeConnection();

        return $projects;
    }

    public function displayProjectsTable()
    {
        $projects = $this->getProjectsList();

        if (empty($projects)) {
            echo "No projects to display.";
            return;
        }

        echo '<table border="1">';
        echo '<tr>';
        echo '<th>Project ID</th>';
        echo '<th>AlunoID</th>';
        echo '<th>Projeto</th>';
        echo '<th>Data Submissao</th>';
        echo '<th>PDF</th>';
        echo '</tr>';

        foreach ($projects as $id => $project) {
            echo '<tr>';
            echo '<td>' . $project["Id_projeto"] . '</td>';
            echo '<td>' . $project["AlunoID"] . '</td>';
            echo '<td>' . $project["Projeto"] . '</td>';
            echo '<td>' . $project["DataSubmissao"] . '</td>';
            echo '<td>' . $project["PDF"] . '</td>';
            echo '</tr>';
        }

        echo '</table>';
    }
}



$projetoAction = new ProjetoAction();
$projetoAction->displayProjectsTable();
include_once "../layouts/footer.php";
?>
</body>
</html>
