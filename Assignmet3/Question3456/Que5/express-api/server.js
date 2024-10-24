const express = require('express');
const app = express();
const PORT = 3000;

app.use(express.json());

app.get('/api/data', (req, res) => {
    res.json({ message: 'Hello from Express!' });
});

app.post('/api/data', (req, res) => {
    const data = req.body;
    res.json({ message: 'Data received', data: data });
});

app.listen(PORT, () => {
    console.log(`Server is running on http://localhost:${PORT}`);
});
