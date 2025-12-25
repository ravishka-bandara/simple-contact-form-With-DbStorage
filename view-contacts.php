<?php
//database connection
require_once 'config/database.php';

//start the session :if needed
 session_start();

 //fetch all contacts from database
 $sql = "SELECT * FROM contacts ORDER BY created_at DESC";
 $stmt = $pdo->query($sql);
 $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View contacts | PHP project 01</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .contacts-container{
            padding: 40px;
        }

        .back-btn{
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #6a11cb;
            font-weight: 600;
        }

        .back-btn i{
            margin-right: 8px;
        }

        .contacts-table{
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        .contacts-table th{
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 15px;
            text-align: left;
        }

        .contacts-table td{
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .contacts-table tr:hover{
            background-color: #f0f;
        }

        .empty-state{
            text-align: center;
            padding: 50px;
            color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1><i class="fas fa-list"></i>Saved Contacts</h1>
            <p class="subtitle">Data retrived from MySQL Database...</p>
        </header>
    </div>

    <div class="contacts-container">
        <a href="index.php" class="back-btn">
            <i class="fas fa-arrow-left"></i>Back to contact form
        </a>

        <?php if(count($contacts)>0): ?>
            <table class="contacts-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Message</th>
                        <th>Data</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($contacts as $contact): ?>
                        <tr>
                            <td><?php echo $contact['id']; ?></td>
                            <td><?php echo htmlspecialchars($contact['name']); ?></td>
                            <td><?php echo htmlspecialchars($contact['email']); ?></td>
                            <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                            <td><?php echo htmlspecialchars($contact['message']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></td>
                        </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>

            <div class="stats" style="margin-top: 20px; color:#f0f">
                <p><i class="fas fa-database"></i>Total contacts: <?php echo count($contacts); ?></p>
            </div>


        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No contacts yet</h3>
                <p>Submit your first contacts through the form idiot!!</p>
            </div>
        <?php endif; ?>
        </div>
    </div>
</body>
</html>
