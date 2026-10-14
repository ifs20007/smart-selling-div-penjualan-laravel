<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        :root { 
            --primary-navy: #003B73; 
            --accent-orange: #F7941D; 
            --bg-body: #F4F7F6;
            --bg-card: #ffffff;
            --text-dark: #2C3E50;
            --text-muted: #7F8C8D;
            --border-light: #E2E8F0;
            --bg-highlight: #F8FAFC;
        }
        
        .forum-wrapper { max-width: 1000px; margin: 0 auto; }
        .header-box { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; flex-wrap: wrap; gap: 15px;}
        .header-box h3 { margin: 0; font-size: 22px; font-weight: 800; color: var(--primary-navy);}
        
        .btn-create { background-color: var(--accent-orange); color: #fff; border: none; padding: 12px 20px; border-radius: 8px; font-weight: bold; font-size: 14px; transition: 0.3s; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.3); display: inline-flex; align-items: center;}
        .btn-create:hover { background-color: #e08316; transform: translateY(-2px); color: #fff;}

        .topic-list { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid var(--border-light); overflow: hidden; padding: 15px; display: flex; flex-direction: column; gap: 10px;}
        .topic-item { display: flex; align-items: center; padding: 20px 15px; border: 1px solid var(--border-light); border-radius: 12px; text-decoration: none; transition: 0.3s; background-color: #ffffff; cursor: pointer;}
        .topic-item:hover { transform: translateY(-2px); box-shadow: 0 8px 15px rgba(0, 59, 115, 0.05); border-color: #cbd5e1;}
        
        .topic-icon { width: 55px; height: 55px; border-radius: 12px; background-color: #e8f4fd; color: var(--primary-navy); display: flex; justify-content: center; align-items: center; font-size: 24px; margin-right: 18px; flex-shrink: 0; transition: 0.3s;}
        .topic-item:hover .topic-icon { background-color: var(--primary-navy); color: #fff;}
        .topic-icon.locked { background-color: #fdedec; color: #e74c3c; }
        .topic-item:hover .topic-icon.locked { background-color: #e74c3c; color: #fff;}
        
        .topic-info { flex: 1; min-width: 0;}
        .topic-title { font-size: 16.5px; font-weight: 800; color: var(--primary-navy); margin-bottom: 6px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .topic-meta { font-size: 12.5px; color: var(--text-muted); font-weight: 500;}
        
        .topic-stats { text-align: right; min-width: 90px; flex-shrink: 0; padding-left: 15px;}
        .topic-stats .replies { font-size: 18px; font-weight: 800; color: var(--text-dark); }
        .topic-stats .replies-label { font-size: 11px; color: var(--text-muted); text-transform: uppercase; font-weight: 700; letter-spacing: 0.5px;}

        /* CLEAN UI MODAL & EDITOR */
        .clean-modal { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .composer-input { width: 100%; padding: 14px 18px; background-color: var(--bg-highlight); color: var(--text-dark); border: 1px solid var(--border-light); border-radius: 10px; font-size: 15px; outline: none; margin-bottom: 20px; transition: 0.3s; font-weight: 600;}
        .composer-input:focus { border-color: var(--primary-navy); box-shadow: 0 0 0 3px rgba(0, 59, 115, 0.1); background-color: #ffffff;}
        
        .ql-toolbar.ql-snow { border: 1px solid var(--border-light) !important; border-radius: 10px 10px 0 0; background-color: var(--bg-highlight); padding: 10px; font-family: inherit;}
        .ql-container.ql-snow { border: 1px solid var(--border-light) !important; border-top: none !important; border-radius: 0 0 10px 10px; background-color: #ffffff; height: 250px; color: var(--text-dark); font-size: 14.5px; font-family: 'Segoe UI', sans-serif;}

        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-modal-save { background-color: var(--accent-orange); color: #ffffff; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.2);}
        .btn-modal-save:hover { background-color: #e08316; }

        @media (max-width: 768px) {
            .header-box h3 { font-size: 18px; text-align: center; width: 100%;}
            .btn-create { width: 100%; text-align: center; justify-content: center;}
            .topic-list { padding: 10px; border-radius: 12px; }
            .topic-item { padding: 15px 10px; }
            .topic-icon { width: 45px; height: 45px; font-size: 18px; margin-right: 12px;}
            .topic-title { font-size: 15px; white-space: normal; line-height:1.4;} 
            .topic-stats { min-width: 60px; padding-left: 10px;}
            .topic-stats .replies { font-size: 16px; }
            .topic-stats .replies-label { font-size: 9px; }
            .ql-container.ql-snow { height: 180px; } 
        }
    </style>

    <div class="py-6 px-4 font-['Segoe_UI',Tahoma,sans-serif]">
        
        @if(session('success'))
            <div style="background: white; border-left: 5px solid #2ecc71; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center; max-width: 1000px; margin-left: auto; margin-right: auto;">
                <i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">{{ session('success') }}</span>
            </div>
        @endif

        <div class="forum-wrapper">
            <div class="header-box">
                <h3><i class="fa-solid fa-comments me-2 text-warning"></i> Forum Aktivitas Pegawai</h3>
                <button class="btn-create" data-bs-toggle="modal" data-bs-target="#modalTopik">
                    <i class="fa-solid fa-plus me-2"></i> Buat Topik Baru
                </button>
            </div>

            <div class="topic-list">
                @if($topics->count() > 0)
                    @foreach($topics as $topic)
                        <a href="{{ route('forum.show', $topic->id) }}" class="topic-item">
                            <div class="topic-icon {{ $topic->is_locked ? 'locked' : '' }}">
                                <i class="fa-solid {{ $topic->is_locked ? 'fa-lock' : 'fa-comments' }}"></i>
                            </div>
                            <div class="topic-info">
                                <div class="topic-title">{{ $topic->judul_topic }}</div>
                                <div class="topic-meta">
                                    Dimulai oleh <strong style="color:var(--text-dark);">{{ $topic->user->name }}</strong> &bull; Pembaruan terakhir: {{ \Carbon\Carbon::parse($topic->updated_at)->format('d M Y H:i') }}
                                </div>
                            </div>
                            <div class="topic-stats">
                                <div class="replies">{{ $topic->comments->count() }}</div>
                                <div class="replies-label">Balasan</div>
                            </div>
                        </a>
                    @endforeach
                @else
                    <div style="text-align: center; padding: 60px 20px; color: var(--text-muted);">
                        <i class="fa-solid fa-folder-open" style="font-size: 50px; margin-bottom: 20px; color: var(--border-light);"></i>
                        <h5 style="color: var(--text-dark); font-weight:bold;">Belum Ada Topik</h5>
                        <p style="font-weight:500;">Jadilah yang pertama membuka diskusi komunitas!</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- MODAL BUAT TOPIK -->
    <div class="modal fade" id="modalTopik" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: var(--primary-navy); font-weight: 800;"><i class="fa-solid fa-pen-to-square me-2 text-warning"></i> Mulai Topik Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('forum.store') }}" method="POST" id="formBuatTopik">
                    @csrf
                    <div class="modal-body border-0 pt-4 pb-0">
                        <input type="text" name="judul_topic" class="composer-input" placeholder="Ketik Judul atau Subjek Topik..." required autocomplete="off">
                        <div id="editor-container"></div>
                        <input type="hidden" name="isi_konten" id="hidden_isi_konten">
                        <small style="color:var(--text-muted); display:block; margin-top:12px; font-weight:500;"><i class="fa-solid fa-circle-info text-primary me-1"></i> Ketik URL gambar secara penuh (berakhiran .jpg / .png) di dalam teks editor. Sistem akan merendernya otomatis menjadi gambar.</small>
                    </div>
                    <div class="modal-footer border-0 pt-4 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-modal btn-modal-save" onclick="siapkanKonten()"><i class="fa-solid fa-paper-plane me-1"></i> Posting Topik</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script>
        var quill = new Quill('#editor-container', {
            theme: 'snow',
            placeholder: 'Tulis isi laporan atau diskusi Anda di sini...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }],
                    ['clean']
                ]
            }
        });
        function siapkanKonten() {
            document.getElementById('hidden_isi_konten').value = quill.root.innerHTML;
        }
    </script>
</x-app-layout>
