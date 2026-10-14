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
        .btn-back { display: inline-flex; align-items: center; background-color: #ffffff; color: var(--text-dark); border: 1px solid var(--border-light); padding: 8px 15px; border-radius: 8px; font-weight: bold; font-size: 13.5px; text-decoration: none; transition: 0.2s; margin-bottom: 20px;}
        .btn-back:hover { background-color: var(--bg-highlight); color: var(--primary-navy); border-color: #cbd5e1;}

        /* POST UTAMA (TOPIK) */
        .post-card { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); border: 1px solid var(--border-light); overflow: hidden; margin-bottom: 20px;}
        .post-header { padding: 20px 25px; border-bottom: 1px solid var(--border-light); background-color: #ffffff;}
        .post-title { font-size: 22px; font-weight: 800; color: var(--primary-navy); margin: 0 0 15px 0; line-height: 1.3;}
        .post-meta { display: flex; align-items: center; font-size: 13.5px; color: var(--text-muted);}
        .author-avatar { width: 40px; height: 40px; border-radius: 50%; background-color: #fef5e7; color: var(--accent-orange); display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 16px; margin-right: 12px; border: 1px solid #fde2b4;}
        .author-info strong { color: var(--text-dark); font-size: 14.5px; display: block;}
        .author-info span { font-size: 12px; }
        
        .role-badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; font-weight: 800; text-transform: uppercase; margin-left: 10px; vertical-align: middle;}
        .role-admin { background-color: #e8f4fd; color: var(--primary-navy); border: 1px solid #b6dfff;}
        .role-pegawai { background-color: #fef5e7; color: var(--accent-orange); border: 1px solid #fde2b4;}

        .post-body { padding: 30px 25px; font-size: 15.5px; line-height: 1.7; color: #34495e;}
        .post-body img { max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); margin: 15px 0; border: 1px solid var(--border-light);}
        
        .post-tools { padding: 12px 25px; background-color: var(--bg-highlight); border-top: 1px solid var(--border-light); display: flex; gap: 10px; justify-content: flex-end;}
        .btn-tool { background: none; border: none; font-size: 13px; font-weight: bold; color: var(--text-muted); cursor: pointer; transition: 0.2s; padding: 5px 10px; border-radius: 5px;}
        .btn-tool:hover { background-color: #e2e8f0; color: var(--primary-navy);}
        .btn-tool.del:hover { background-color: #fdf2f2; color: #e74c3c;}

        /* POST KOMENTAR */
        .reply-card { background-color: var(--bg-card); border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); border: 1px solid var(--border-light); margin-bottom: 15px; margin-left: 40px; display: flex; overflow: hidden;}
        .reply-left { width: 5px; background-color: var(--border-light); }
        .reply-content { flex: 1; display: flex; flex-direction: column;}
        
        .reply-header { padding: 15px 20px 10px; display: flex; align-items: center; justify-content: space-between;}
        .reply-meta { display: flex; align-items: center; }
        .reply-avatar { width: 32px; height: 32px; border-radius: 50%; background-color: #f1f5f9; color: var(--text-muted); display: flex; justify-content: center; align-items: center; font-weight: bold; font-size: 13px; margin-right: 10px; border: 1px solid #e2e8f0;}
        .reply-author { font-size: 13.5px; color: var(--text-dark); font-weight: 700;}
        .reply-time { font-size: 11.5px; color: var(--text-muted); font-weight: 500;}

        .reply-body { padding: 5px 20px 15px; font-size: 14.5px; line-height: 1.6; color: #475569;}
        
        /* EDITOR & FORMS */
        .editor-box { background-color: #ffffff; border-radius: 16px; border: 1px solid var(--border-light); padding: 25px; margin-top: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.03);}
        .ql-toolbar.ql-snow { border: 1px solid var(--border-light) !important; border-radius: 10px 10px 0 0; background-color: var(--bg-highlight); padding: 10px;}
        .ql-container.ql-snow { border: 1px solid var(--border-light) !important; border-top: none !important; border-radius: 0 0 10px 10px; height: 180px; font-family: 'Segoe UI', sans-serif; font-size: 14.5px;}
        .btn-reply { background-color: var(--primary-navy); color: #fff; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; font-size: 14px; float: right; margin-top: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(0, 59, 115, 0.2);}
        .btn-reply:hover { background-color: #002D59; transform: translateY(-2px);}
        
        .locked-banner { background-color: #fdedec; border: 1px solid #fadbd8; color: #e74c3c; padding: 25px; border-radius: 12px; text-align: center; margin-top: 30px;}

        /* CLEAN UI MODAL & EDITOR */
        .clean-modal { background-color: var(--bg-card); border-radius: 16px; box-shadow: 0 20px 40px rgba(0,0,0,0.1); border: none; }
        .btn-modal { padding: 10px 20px; border-radius: 8px; font-size: 13.5px; font-weight: bold; border: none; cursor: pointer; transition: 0.3s; }
        .btn-modal-cancel { background-color: #F1F5F9; color: var(--text-muted); }
        .btn-modal-cancel:hover { background-color: #E2E8F0; color: var(--text-dark); }
        .btn-modal-save { background-color: var(--accent-orange); color: #ffffff; box-shadow: 0 4px 10px rgba(247, 148, 29, 0.2);}
        .btn-modal-save:hover { background-color: #e08316; }

        @media (max-width: 768px) {
            .reply-card { margin-left: 15px;}
            .post-header, .post-body, .reply-header, .reply-body { padding: 15px;}
            .post-title { font-size: 18px;}
            .author-avatar { width: 35px; height: 35px; font-size: 14px;}
        }
    </style>

    @php
        function bersihkanDanEmbed($teks) {
            $teks = strip_tags($teks, '<p><b><i><u><strong><em><s><br><ul><ol><li><span>');
            $pola_gambar = '/(https?:\/\/[^\s<"\'&]+?\.(?:jpg|jpeg|png|gif|webp))/i';
            $ganti_gambar = '<div style="margin: 15px 0;">
                                <a href="$1" target="_blank">
                                    <img src="$1" style="max-width: 100%; max-height: 400px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); border:1px solid #E2E8F0;">
                                </a>
                            </div>';
            return preg_replace($pola_gambar, $ganti_gambar, $teks);
        }
    @endphp

    <div class="py-6 px-4 font-['Segoe_UI',Tahoma,sans-serif]">
        
        @if(session('success'))
            <div style="background: white; border-left: 5px solid #2ecc71; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center; max-width: 1000px; margin-left: auto; margin-right: auto;">
                <i class="fa-solid fa-circle-check" style="color: #2ecc71; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div style="background: white; border-left: 5px solid #e74c3c; padding: 15px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); margin-bottom: 20px; display: flex; align-items: center; max-width: 1000px; margin-left: auto; margin-right: auto;">
                <i class="fa-solid fa-triangle-exclamation" style="color: #e74c3c; font-size: 18px; margin-right: 10px;"></i>
                <span style="font-weight: 500; font-size: 14px; color: var(--text-dark);">{{ session('error') }}</span>
            </div>
        @endif

        <div class="forum-wrapper">
            <a href="{{ route('forum.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2" style="margin-right: 5px;"></i> Kembali ke Forum Utama
            </a>

            <!-- POST UTAMA -->
            <div class="post-card">
                <div class="post-header">
                    <h1 class="post-title">{{ $topic->judul_topic }}</h1>
                    <div class="post-meta">
                        <div class="author-avatar">{{ strtoupper(substr($topic->user->name, 0, 1)) }}</div>
                        <div class="author-info">
                            <strong>
                                {{ $topic->user->name }}
                                <span class="role-badge {{ $topic->user->role === 'Admin' ? 'role-admin' : 'role-pegawai' }}">
                                    <i class="fa-solid {{ $topic->user->role === 'Admin' ? 'fa-user-shield' : 'fa-user-tie' }}" style="margin-right:3px;"></i> {{ $topic->user->role }}
                                </span>
                            </strong>
                            <span>Diposting pada {{ \Carbon\Carbon::parse($topic->created_at)->format('d M Y, H:i') }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="post-body">
                    {!! $topic->isi_konten !!}
                </div>
                
                @if($topic->users_id == auth()->user()->users_id)
                <div class="post-tools">
                    <button class="btn-tool" data-bs-toggle="modal" data-bs-target="#modalEditTopik" onclick="bukaModalEditTopik()"><i class="fa-solid fa-pen me-1"></i> Edit Topik</button>
                </div>
                @endif
            </div>

            <!-- DAFTAR KOMENTAR -->
            <h5 style="color: var(--text-dark); font-weight: 800; font-size: 16px; margin: 30px 0 15px 5px;"><i class="fa-regular fa-comments text-primary me-2"></i> {{ $topic->comments->count() }} Balasan</h5>

            @foreach($topic->comments as $komen)
                <div class="reply-card" id="komen-{{ $komen->id }}">
                    <div class="reply-left"></div>
                    <div class="reply-content">
                        <div class="reply-header">
                            <div class="reply-meta">
                                <div class="reply-avatar">{{ strtoupper(substr($komen->user->name, 0, 1)) }}</div>
                                <div>
                                    <div class="reply-author">
                                        {{ $komen->user->name }} 
                                        <span class="role-badge {{ $komen->user->role === 'Admin' ? 'role-admin' : 'role-pegawai' }}" style="font-size:9px; padding:1px 6px;">
                                            {{ $komen->user->role }}
                                        </span>
                                    </div>
                                    <div class="reply-time">{{ \Carbon\Carbon::parse($komen->created_at)->diffForHumans() }} ({{ \Carbon\Carbon::parse($komen->created_at)->format('d/m/Y H:i') }})</div>
                                </div>
                            </div>
                        </div>
                        <div class="reply-body">
                            {!! bersihkanDanEmbed($komen->isi_komentar) !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- KOTAK BALASAN (REPLY) -->
            <div id="bottom"></div>
            @if(!$topic->is_locked)
                <div class="editor-box">
                    <h5 style="color:var(--primary-navy); margin-bottom:15px; font-weight:800;"><i class="fa-solid fa-reply me-2 text-warning"></i> Berikan Tanggapan</h5>
                    <form action="{{ route('forum.komentar.store', $topic->id) }}" method="POST" id="formBalasan">
                        @csrf
                        <div id="reply-editor"></div>
                        <input type="hidden" name="isi_komentar" id="hidden_isi_komentar">
                        <small style="color:var(--text-muted); display:block; margin-top:12px; font-weight:500;"><i class="fa-solid fa-circle-info text-primary me-1"></i> Tempel (Paste) URL gambar secara penuh untuk melampirkan foto laporan.</small>
                        <button type="submit" name="kirim_komentar" class="btn-reply" onclick="siapkanBalasan()"><i class="fa-solid fa-paper-plane me-1"></i> Kirim Balasan</button>
                        <div style="clear:both;"></div>
                    </form>
                </div>
            @else
                <div class="locked-banner">
                    <i class="fa-solid fa-lock" style="font-size:30px; display:block; margin-bottom:10px;"></i> 
                    Topik Ini Telah Dikunci<br><small style="font-weight:500;">Diskusi telah berakhir dan tidak menerima balasan baru.</small>
                </div>
            @endif

        </div>
    </div>

    <!-- MODAL EDIT TOPIK UTAMA -->
    <div class="modal fade" id="modalEditTopik" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content clean-modal">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title" style="color: var(--primary-navy); font-weight: 800;"><i class="fa-solid fa-pen-to-square me-2 text-warning"></i> Edit Topik</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('forum.update', $topic->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body border-0 pt-4 pb-0">
                        <div id="edit-topic-editor"></div>
                        <input type="hidden" name="isi_konten_edit" id="hidden_edit_topik">
                    </div>
                    <div class="modal-footer border-0 pt-4 pb-4" style="justify-content: flex-end; gap: 10px; padding-right:16px;">
                        <button type="button" class="btn-modal btn-modal-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="simpan_edit_topik" class="btn-modal btn-modal-save" onclick="siapkanEditTopik()"><i class="fa-solid fa-rotate me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div id="raw-topic-html" style="display:none;">{{ htmlspecialchars($topic->isi_konten, ENT_QUOTES) }}</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.quilljs.com/1.3.7/quill.js"></script>
    <script>
        var toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'color': [] }],
            ['clean']
        ];

        @if(!$topic->is_locked)
        var replyQuill = new Quill('#reply-editor', { theme: 'snow', placeholder: 'Ketik balasan Anda disini...', modules: { toolbar: toolbarOptions }});
        function siapkanBalasan() { document.getElementById('hidden_isi_komentar').value = replyQuill.root.innerHTML; }
        @endif

        var editTopicQuill = new Quill('#edit-topic-editor', { theme: 'snow', modules: { toolbar: toolbarOptions }});
        
        function bukaModalEditTopik() {
            var htmlAsli = document.getElementById('raw-topic-html').innerHTML;
            var doc = new DOMParser().parseFromString(htmlAsli, "text/html");
            editTopicQuill.root.innerHTML = doc.documentElement.textContent;
        }
        function siapkanEditTopik() { document.getElementById('hidden_edit_topik').value = editTopicQuill.root.innerHTML; }
    </script>
</x-app-layout>
