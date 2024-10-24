const express = require('express');
const axios = require('axios');

const app = express();
const PORT = 3000;

app.use(express.json());

// GET request to fetch book data from the PHP API
app.get('/books', async (req, res) => {
    try {
        const response = await axios.get('http://localhost/Ass1/Que6/api.php');
        res.json(response.data);
    } catch (error) {
        console.error('Error fetching from PHP API:', error.message);
        res.status(500).json({ message: 'Error calling PHP API' });
    }
});

// POST request to add a new book via the PHP API
app.post('/books', async (req, res) => {
    try {
        const response = await axios.post('http://localhost/Ass1/Que6/api.php', req.body);
        res.json(response.data);
    } catch (error) {
        console.error('Error posting to PHP API:', error.message);
        res.status(500).json({ message: 'Error calling PHP API' });
    }
});

app.listen(PORT, () => {
    console.log(`Express server running at http://localhost:${PORT}`);
});