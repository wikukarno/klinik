import express from "express";
import { createServer } from "http";
import { Server } from "socket.io";

// Inisialisasi server
const app = express();
const server = createServer(app);
const io = new Server(server, {
    cors: {
        origin: "*", // Sesuaikan dengan domain frontend Anda
        methods: ["GET", "POST"],
    },
});

// Middleware untuk menangani JSON
app.use(express.json());

// Endpoint untuk menerima data dari Laravel
app.post("/update-antrian", (req, res) => {
    const data = req.body;
    console.log("Data received from Laravel:", data);

    // Emit data ke semua client
    io.emit("refresh:antrian", data);

    // Kirim respons sukses ke Laravel
    res.status(200).send({ message: "Data emitted to clients", data });
});

// Socket.IO logic untuk koneksi realtime
io.on("connection", (socket) => {
    console.log(`User connected: ${socket.id}`);

    // Event untuk update antrian langsung dari client (opsional)
    socket.on("update:antrian", (data) => {
        console.log("Update from client:", data);
        io.emit("refresh:antrian", data);
    });

    socket.on("disconnect", () => {
        console.log(`User disconnected: ${socket.id}`);
    });
});

// Jalankan server
const PORT = 6001;
server.listen(PORT, () => {
    console.log(`Socket.IO server running on port ${PORT}`);
});
