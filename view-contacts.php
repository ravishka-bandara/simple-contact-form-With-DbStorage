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
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url(assets/images/background.png);
            min-height: 100vh;
            border-radius: 25px;
        }
        
        .main-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        /* Header Styles */
        .page-header {
            background: rgba(20, 20, 30, 0.75);
            backdrop-filter: blur(16px);
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border-bottom: 5px solid #ffffffff;
            border-radius: 25px;
        }
        
        .page-header h1 {
            color: #ffffffff;
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .page-header h1 i {
            color: #ffffffff;
            margin-right: 15px;
        }
        
        .page-header .subtitle {
            color: #cbc9c9ff;
            font-size: 1.2em;
            margin-top: 10px;
        }
        
        /* Content Container */
        .page-content {
            flex: 1;
            padding: 40px 20px;
            background: rgba(255, 255, 255, 0);
            backdrop-filter: blur(16px);
            border-radius: 25px;
        }
        
        .contacts-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: rgba(20, 20, 30, 0.265);
    backdrop-filter: blur(16px);
        }
        
        /* Back Button */
        .back-btn{
            display: inline-flex;
            align-items: center;
            margin-bottom: 30px;
            text-decoration: none;
            color: white;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            padding: 15px 30px;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }
        
        .back-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(106, 17, 203, 0.4);
        }
        
        .back-btn i{
            margin-right: 10px;
            font-size: 1.2em;
        }
        
        /* Table Styles */
        .table-responsive {
            overflow-x: auto;
            margin: 30px 0;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .contacts-table{
            width: 100%;
            border-collapse: collapse;
            min-width: 800px; /* Ensures table doesn't get too narrow */
        }
        
        .contacts-table th{
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 20px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 1.1em;
        }
        
        .contacts-table td{
            padding: 18px 15px;
            border-bottom: 1px solid #eee;
            color: #333;
        }
        
        .contacts-table tr:nth-child(even){
            background-color: #f9f9f9;
        }
        
        .contacts-table tr:hover{
            background-color: #f0f7ff;
            transform: scale(1.002);
            transition: all 0.2s ease;
        }
        
        /* Message cell styling */
        .contacts-table td:nth-child(5) {
            max-width: 300px;
            word-wrap: break-word;
        }
        
        /* Stats Section */
        .stats {
            margin-top: 30px;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 10px;
            text-align: center;
            border-left: 5px solid #6a11cb;
        }
        
        .stats p {
            color: #333;
            font-size: 1.2em;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .stats i {
            color: #6a11cb;
            font-size: 1.5em;
        }
        
        /* Empty State */
        .empty-state{
            text-align: center;
            padding: 60px 40px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .empty-state i{
            font-size: 4em;
            color: #ddd;
            margin-bottom: 20px;
        }
        
        .empty-state h3{
            color: #666;
            font-size: 1.8em;
            margin-bottom: 15px;
        }
        
        .empty-state p{
            color: #888;
            font-size: 1.1em;
            margin-bottom: 30px;
        }
        
        /* Mobile Cards View (Hidden on Desktop) */
        .mobile-contacts {
            display: none;
        }
        
        .contact-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
            border-left: 5px solid #6a11cb;
            transition: transform 0.3s ease;
        }
        
        .contact-card:hover {
            transform: translateY(-5px);
        }
        
        .contact-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
        }
        
        .contact-id {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: bold;
            font-size: 0.9em;
        }
        
        .contact-date {
            color: #666;
            font-size: 0.9em;
            font-weight: 600;
        }
        
        .contact-field {
            margin-bottom: 15px;
            display: flex;
            align-items: flex-start;
            padding: 10px 0;
        }
        
        .field-label {
            font-weight: 600;
            min-width: 100px;
            color: #555;
            font-size: 0.95em;
        }
        
        .field-value {
            flex: 1;
            color: #333;
            word-break: break-word;
        }
        
        .field-value.email {
            color: #2575fc;
            font-weight: 500;
        }
        
        .field-value.phone {
            color: #28a745;
            font-weight: 500;
        }
        
        /* Message field specific styling */
        .message-field {
            flex-direction: column;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-top: 10px;
            border-left: 4px solid #6a11cb;
        }
        
        .message-field .field-label {
            min-width: 100%;
            margin-bottom: 10px;
            color: #6a11cb;
            font-size: 1em;
        }
        
        .message-field .field-value {
            font-style: italic;
            line-height: 1.6;
        }
        
        /* ======== Mobile Responsive Styles ======== */
        @media (max-width: 768px) {
            .page-header {
                padding: 30px 20px;
            }
            
            .page-header h1 {
                font-size: 2em;
            }
            
            .page-header .subtitle {
                font-size: 1em;
            }
            
            .page-content {
                padding: 20px 15px;
                background: #f8f9fa;
            }
            
            .contacts-container {
                padding: 25px;
                border-radius: 15px;
                margin: 0;
            }
            
            .back-btn {
                width: 100%;
                justify-content: center;
                padding: 18px;
                margin-bottom: 25px;
                font-size: 1.1em;
            }
            
            /* Hide desktop table on mobile */
            .table-responsive {
                display: none;
            }
            
            /* Show mobile cards on mobile */
            .mobile-contacts {
                display: block;
            }
            
            .contact-card {
                padding: 20px;
                margin-bottom: 15px;
            }
            
            .contact-field {
                flex-direction: column;
                margin-bottom: 12px;
            }
            
            .field-label {
                min-width: 100%;
                margin-bottom: 5px;
                font-size: 0.9em;
                color: #777;
            }
            
            .field-value {
                width: 100%;
                font-size: 1em;
            }
            
            .stats {
                margin-top: 25px;
                padding: 15px;
            }
            
            .stats p {
                font-size: 1.1em;
            }
            
            .empty-state {
                padding: 40px 20px;
            }
            
            .empty-state i {
                font-size: 3em;
            }
            
            .empty-state h3 {
                font-size: 1.5em;
            }
            
            .empty-state p {
                font-size: 1em;
                margin-bottom: 25px;
            }
            
            /* Add Contact button in empty state */
            .empty-state .back-btn {
                display: inline-flex;
                width: auto;
                margin-top: 20px;
            }
        }
        
        /* Small Phones */
        @media (max-width: 480px) {
            .page-header {
                padding: 25px 15px;
            }
            
            .page-header h1 {
                font-size: 1.7em;
            }
            
            .contacts-container {
                padding: 20px;
            }
            
            .contact-card {
                padding: 15px;
            }
            
            .contact-id {
                font-size: 0.8em;
                padding: 6px 12px;
            }
            
            .contact-date {
                font-size: 0.8em;
            }
            
            .empty-state {
                padding: 30px 15px;
            }
        }
        
        /* Tablet Styles */
        @media (min-width: 769px) and (max-width: 1024px) {
            .contacts-container {
                padding: 35px;
            }
            
            .contacts-table {
                font-size: 0.95em;
            }
            
            .contacts-table th,
            .contacts-table td {
                padding: 15px 12px;
            }
        }
        
        /* Hide mobile cards on desktop */
        @media (min-width: 769px) {
            .mobile-contacts {
                display: none;
            }
            
            .table-responsive {
                display: block;
            }
        }
        
        /* Desktop Large Screens */
        @media (min-width: 1200px) {
            .contacts-container {
                padding: 50px;
            }
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Separate Header Section -->
        <header class="page-header">
            <h1><i class="fas fa-list"></i>Saved Contacts</h1>
            <p class="subtitle">Data retrieved from MySQL Database</p>
        </header>
        
        <!-- Main Content Area -->
        <main class="page-content">
            <div class="contacts-container">
                <a href="index.php" class="back-btn">
                    <i class="fas fa-arrow-left"></i> Back to Contact Form
                </a>

                <?php if(count($contacts) > 0): ?>
                    <!-- Desktop Table View (Hidden on Mobile) -->
                    <div class="table-responsive">
                        <table class="contacts-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Message</th>
                                    <th>Date</th>
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
                    </div>

                    <!-- Mobile Cards View (Hidden on Desktop) -->
                    <div class="mobile-contacts">
                        <?php foreach ($contacts as $contact): ?>
                        <div class="contact-card">
                            <div class="contact-card-header">
                                <span class="contact-id">ID: <?php echo $contact['id']; ?></span>
                                <span class="contact-date"><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></span>
                            </div>
                            
                            <div class="contact-field">
                                <span class="field-label">Name:</span>
                                <span class="field-value"><?php echo htmlspecialchars($contact['name']); ?></span>
                            </div>
                            
                            <div class="contact-field">
                                <span class="field-label">Email:</span>
                                <span class="field-value email"><?php echo htmlspecialchars($contact['email']); ?></span>
                            </div>
                            
                            <?php if (!empty($contact['phone'])): ?>
                            <div class="contact-field">
                                <span class="field-label">Phone:</span>
                                <span class="field-value phone"><?php echo htmlspecialchars($contact['phone']); ?></span>
                            </div>
                            <?php endif; ?>
                            
                            <div class="contact-field message-field">
                                <span class="field-label">Message:</span>
                                <span class="field-value"><?php echo htmlspecialchars($contact['message']); ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="stats">
                        <p><i class="fas fa-database"></i> Total contacts: <?php echo count($contacts); ?></p>
                    </div>

                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h3>No contacts yet</h3>
                        <p>Submit your first contact through the form!</p>
                        <a href="index.php" class="back-btn">
                            <i class="fas fa-plus"></i> Add First Contact
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <script>
        // Add interactivity
        document.addEventListener('DOMContentLoaded', function() {
            // Add click animation to mobile cards
            const cards = document.querySelectorAll('.contact-card');
            cards.forEach(card => {
                card.addEventListener('click', function() {
                    this.style.transform = 'scale(0.98)';
                    setTimeout(() => {
                        this.style.transform = '';
                    }, 200);
                });
            });
            
            // Log view type
            if (window.innerWidth <= 768) {
                console.log(' Mobile view: Showing contact cards');
            } else {
                console.log(' Desktop view: Showing table');
            }
        });
    </script>
</body>
</html>