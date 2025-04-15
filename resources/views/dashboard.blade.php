<!-- Font Awesome 5 via CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- ATAU Font Awesome 6 via CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@extends('layouts.app')

@section('content')


<div class="container py-5">
    <!-- Notification Banner -->
    <div class="alert alert-info d-flex align-items-center mb-4 rounded-3 shadow-sm border-0" role="alert">
        <i class="fas fa-bell me-3 fs-5"></i>
        <div class="fw-medium">🔥 Update terbaru: Jangan lewatkan tips menarik hari ini!</div>
    </div>


<!-- Stats Row
<div class="container">
    <div class="row mb-4">
        <div class="col-md-3 mb-3">
            <div class="stat-box bg-success text-center shadow p-3 rounded-3">
                <div class="text-white">
                    <strong>Total Upload</strong> <br>
                    <span class="fs-1 fw-bold">{{ $totalUpload ?? 0 }}</span>
                    <p class="mb-0 small">{{ ($totalUpload ?? 0) == 0 ? 'Belum ada data' : 'Dokumen' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-box bg-primary text-center shadow p-3 rounded-3">
                <div class="text-white">
                    <strong>Total Penilaian</strong> <br>
                    <span class="fs-1 fw-bold">{{ $totalPenilaian ?? 0 }}</span>
                    <p class="mb-0 small">{{ ($totalPenilaian ?? 0) == 0 ? 'Belum ada data' : 'Penilaian' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-box bg-warning text-center shadow p-3 rounded-3">
                <div class="text-white">
                    <strong>Penilaian Selesai</strong> <br>
                    <span class="fs-1 fw-bold">{{ $penilaianSelesai ?? 0 }}</span>
                    <p class="mb-0 small">{{ ($penilaianSelesai ?? 0) == 0 ? 'Belum ada data' : 'Selesai' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3 mb-3">
            <div class="stat-box bg-info text-center shadow p-3 rounded-3">
                <div class="text-white">
                    <strong>Rata-rata Nilai</strong> <br>
                    <span class="fs-1 fw-bold">{{ number_format($rataRataNilai ?? 0, 1) }}</span>
                    <p class="mb-0 small">{{ ($rataRataNilai ?? 0) == 0 ? 'Belum ada data' : 'Rata-rata' }}</p>
                </div>
            </div>
        </div>
    </div>
</div> -->

    <!-- Main Row -->
    <div class="row g-4">
        <!-- User Profile Card -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow border-0 h-100 rounded-3 overflow-hidden">
                <div class="card-body text-center p-5">
                    <div class="mb-4 position-relative">
                        <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex p-3">
                            <img src="../assets/images/backgrounds/product-tip.png" alt="Profile" class="img-fluid rounded-circle shadow-sm" width="100">
                        </div>
                    </div>
                    @auth
                        <h3 class="mb-2 fw-bold">Hai, {{ Auth::user()->name }}!</h3>
                    @else
                        <h3 class="mb-2 fw-bold">Hai, Guest!</h3>
                    @endauth
                    <p class="text-muted mb-4">Dapatkan wawasan dan tips terbaru untuk meningkatkan produktivitas Anda!</p>
                    <button class="btn btn-primary px-4 py-2 rounded-pill fw-medium">
                        <i class="fas fa-lightbulb me-2"></i>Lihat Semua Tips
                    </button>
                </div>
                <div class="card-footer bg-primary bg-opacity-10 text-center py-3 border-0">
                    <small class="text-primary fw-medium"><i class="fas fa-star me-1"></i> Premium member</small>
                </div>
            </div>
        </div>

        <!-- Notes Card -->
        <div class="col-lg-8 mb-4">
    <div class="card shadow border-0 rounded-3 overflow-hidden">
        <div class="card-header bg-white py-4 d-flex justify-content-between align-items-center border-0">
            <h4 class="mb-0 fw-bold">
                <i class="fas fa-sticky-note me-2 text-primary"></i>Catatan Saya
            </h4>
            <div>
                <button id="filterButton" class="btn btn-outline-secondary btn-sm rounded-pill px-3 me-2">
                    <i class="fas fa-filter me-1"></i> Filter
                </button>
                <button onclick="resetNotes()" class="btn btn-outline-danger btn-sm rounded-pill px-3 me-2">
                    <i class="fas fa-trash-alt me-1"></i> Reset
                </button>
                <button onclick="downloadNotes()" class="btn btn-outline-success btn-sm rounded-pill px-3">
                    <i class="fas fa-download me-1"></i> Unduh
                </button>
            </div>
        </div>
        
        <div class="card-body p-4">
    <div class="mb-3">
        <div class="input-group">
            <textarea id="noteInput" class="form-control border-0 bg-light p-3 rounded-start" rows="3" placeholder="Tambahkan catatan baru..."></textarea>
            <button onclick="addNote()" class="btn btn-primary px-4 rounded-end">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</div>
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <small class="text-muted">
                    <i class="far fa-lightbulb me-2"></i>Tip: Catatan Anda disimpan di browser ini
                </small>
                <div class="btn-group" role="group">
                    <button id="showAllNotes" class="btn btn-sm btn-outline-primary active">Semua</button>
                    <button id="showActiveNotes" class="btn btn-sm btn-outline-primary">Aktif</button>
                    <button id="showCompletedNotes" class="btn btn-sm btn-outline-primary">Selesai</button>
                </div>
            </div>
            
            <div id="emptyState" class="text-center py-5 d-none">
                <div class="bg-light rounded-circle d-inline-flex p-4 mb-3">
                    <i class="far fa-sticky-note text-muted" style="font-size: 2.5rem;"></i>
                </div>
                <p class="mt-3 text-muted fs-5">Belum ada catatan. Mulai tambahkan sekarang!</p>
            </div>
            
            <ul id="noteList" class="list-group list-group-flush"></ul>
        </div>
    </div>
</div>

<!-- JavaScript for Notes -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        loadNotes();

        document.getElementById("showAllNotes").addEventListener("click", function () {
            setActiveFilter(this);
            loadNotes("all");
        });
        document.getElementById("showActiveNotes").addEventListener("click", function () {
            setActiveFilter(this);
            loadNotes("active");
        });
        document.getElementById("showCompletedNotes").addEventListener("click", function () {
            setActiveFilter(this);
            loadNotes("completed");
        });
    });

    function setActiveFilter(el) {
        document.querySelectorAll(".btn-group .btn").forEach(btn => btn.classList.remove("active"));
        el.classList.add("active");
    }

    function addNote() {
        let input = document.getElementById("noteInput");
        let text = input.value.trim();
        if (!text) return;

        let notes = JSON.parse(localStorage.getItem("notes") || "[]");
        notes.push({ id: Date.now(), text, checked: false, date: new Date().toISOString() });
        localStorage.setItem("notes", JSON.stringify(notes));

        input.value = "";
        loadNotes();
    }

    function loadNotes(filter = "all") {
        let notes = JSON.parse(localStorage.getItem("notes") || "[]");
        let list = document.getElementById("noteList");
        let emptyState = document.getElementById("emptyState");

        list.innerHTML = "";
        if (filter === "active") notes = notes.filter(n => !n.checked);
        if (filter === "completed") notes = notes.filter(n => n.checked);

        if (notes.length === 0) {
            emptyState.classList.remove("d-none");
            return;
        } else {
            emptyState.classList.add("d-none");
        }

        notes.forEach(note => {
            let li = document.createElement("li");
            li.className = "list-group-item d-flex justify-content-between align-items-center";

            let left = document.createElement("div");
            left.className = "d-flex align-items-center";
            let checkbox = document.createElement("input");
            checkbox.type = "checkbox";
            checkbox.className = "form-check-input me-3";
            checkbox.checked = note.checked;
            checkbox.addEventListener("change", () => toggleNote(note.id));
            let span = document.createElement("span");
            span.textContent = note.text;
            span.className = note.checked ? "text-decoration-line-through text-muted" : "fw-medium";
            left.appendChild(checkbox);
            left.appendChild(span);

            let btn = document.createElement("button");
            btn.className = "btn btn-sm text-danger";
            btn.innerHTML = '<i class="fas fa-trash"></i>';
            btn.addEventListener("click", () => deleteNote(note.id));

            li.appendChild(left);
            li.appendChild(btn);
            list.appendChild(li);
        });
    }

    function toggleNote(id) {
        let notes = JSON.parse(localStorage.getItem("notes") || "[]");
        let index = notes.findIndex(n => n.id === id);
        if (index !== -1) {
            notes[index].checked = !notes[index].checked;
            localStorage.setItem("notes", JSON.stringify(notes));
            loadNotes();
        }
    }

    function deleteNote(id) {
        let notes = JSON.parse(localStorage.getItem("notes") || "[]");
        notes = notes.filter(n => n.id !== id);
        localStorage.setItem("notes", JSON.stringify(notes));
        loadNotes();
    }

    function resetNotes() {
        if (confirm("Yakin ingin menghapus semua catatan?")) {
            localStorage.removeItem("notes");
            loadNotes();
        }
    }
</script>
@endsection