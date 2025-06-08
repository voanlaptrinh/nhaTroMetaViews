
    <div class="container">
        <h4>Quản lý điện nước</h4>

        <form method="GET" action="{{ route('diennuoc.index') }}" class="mb-3">
            <div class="row g-2">
                <div class="col-md-4">
                    <label>Tòa nhà</label>
                    <select name="nha_tro_id" class="form-select" required>
                        <option value="">-- Chọn tòa nhà --</option>
                        @foreach ($nhaTros as $nt)
                            <option value="{{ $nt->id }}" {{ $selectedNhaTroId == $nt->id ? 'selected' : '' }}>
                                {{ $nt->ten_toa_nha }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Tháng</label>
                    <select name="thang" class="form-select" required>
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $thang == $i ? 'selected' : '' }}>{{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Năm</label>
                    <input type="number" name="nam" class="form-control" value="{{ $nam ?? date('Y') }}" required>
                </div>
                <div class="col-md-2 align-self-end">
                    <button class="btn btn-primary w-100">Xem dữ liệu</button>
                </div>
            </div>
        </form>

        @if ($canTao)
            <form method="POST" action="{{ route('diennuoc.store') }}">
                @csrf
                <input type="hidden" name="nha_tro_id" value="{{ $selectedNhaTroId }}">
                <input type="hidden" name="thang" value="{{ $thang }}">
                <input type="hidden" name="nam" value="{{ $nam }}">
                <button class="btn btn-success">Tạo dữ liệu điện nước</button>
            </form>
        @endif

        @if (!empty($dienNuocs))
            <form method="POST">
                <table class="table table-bordered mt-3">
                    <thead>
                        <tr>
                            <th>Phòng</th>
                            <th>Số điện (kWh)</th>
                            <th>Số nước (m³)</th>
                            <th>Số người</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dienNuocs as $dn)
                            <tr>
                                <form method="POST" action="{{ route('diennuoc.update', $dn->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <td>{{ optional($dn->room)->ten_phong }}</td>
                                    <td>
                                        <input type="number" step="0.1" name="so_dien" class="form-control"
                                            value="{{ $dn->so_dien }}">
                                    </td>

                                    {{-- Xử lý hiển thị theo kiểu tính --}}
                                 
                                    <td>
                                        @if ($kieuTinhNuoc == 'cong_to')
                                            <input type="number" step="0.1" name="so_nuoc" class="form-control"
                                                value="{{ $dn->so_nuoc }}">
                                        @elseif($kieuTinhNuoc == 'dau_nguoi')
                                            <input type="number" class="form-control" value="{{ $dn->so_nguoi }}"
                                                readonly>
                                        @elseif($kieuTinhNuoc == 'co_dinh')
                                            <input type="text" class="form-control" value="1" readonly>
                                        @endif
                                    </td>

                                    <td>
                                        <input type="number" name="so_nguoi" class="form-control"
                                            value="{{ $dn->so_nguoi }}">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-primary">Lưu</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </form>
        @endif
    </div>

