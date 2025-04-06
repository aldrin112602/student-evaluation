import express from 'express';  // Import express using ES module syntax
import mysql from 'mysql2';     // Import mysql2 using ES module syntax

const app = express();
const port = 4000;  // You might want to use port 3000 for the web server

// Create MySQL connection
const connection = mysql.createConnection({
    host: '127.0.0.1',    // Your database host
    user: 'root',         // Your database username
    password: '',         // Your database password
    database: 'studentEvaluation' // Your database name
});

// Connect to the database
connection.connect((err) => {
    if (err) {
        console.error('Error connecting to MySQL: ', err.stack);
        return;
    }
    console.log('Connected to MySQL as id ' + connection.threadId);
});

// API route to fetch student grades data
app.get('/grades', (req, res) => {
    // Query to get the student grades (assuming you have a 'grades' table with 'student_id' and 'remarks')
    connection.query('SELECT student_id, remarks FROM grades', (err, results) => {
        if (err) {
            console.error('Error fetching data: ', err);
            res.status(500).json({ error: 'Database query failed' });
            return;
        }
        // Send the result back as a JSON response
        res.json(results);
    });
});

// Serve the frontend (optional, if you want to serve HTML directly)
app.use(express.static('public')); // Serve static files from 'public' folder (your frontend)

// Start the server
app.listen(port, () => {
    console.log(`Server running on http://localhost:${port}`);
});
