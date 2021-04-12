
<div class="col-md-12 col-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Data Barang</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                <div class="form-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="first-name-icon">Nama Barang</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($b) ? $b->nama_barang : old("nama_barang")}}"
                                    type="text"
                                    id="first-name-icon"
                                    class="form-control @error("nama_barang") is-invalid @enderror"
                                    name="nama_barang"
                                    placeholder="Nama Barang">
                                    <div class="form-control-position">
                                        <i class="feather icon-user"></i>
                                    </div>
                                    @error('nama_barang')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="display: none" class="col-12" id="editor">
                            <div class="form-group">
                                <label for="">Keterangan Paket</label>
                                <textarea name="keterangan">
                                    {!! isset($b) ? $b->keterangan : "" !!}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="email-id-icon">Harga Barang</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    value="{{isset($b) ? $b->harga_barang : old("harga_barang")}}"
                                    type="number"
                                    id="email-id-icon"
                                    class="form-control @error("harga_barang") is-invalid @enderror"
                                    name="harga_barang"
                                    placeholder="Harga Barang">
                                    <div class="form-control-position">
                                        <i class="feather icon-dollar-sign"></i>
                                    </div>
                                    @error('harga_barang')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="password-icon">Kategori Barang</label>
                                <div class="position-relative has-icon-left">
                                    <select id="kategori" class="form-control" name="id_kategori">
                                        <option value="#" disabled selected>Pilih Kategori Barang</option>
                                        @foreach ($kategori as $kt)
                                            <option
                                            {{isset($b) && $b->id_kategori === $kt->id_kategori ? "selected" : "" }}
                                                value="{{$kt->id_kategori.'-'.$kt->nama_kategori}}">
                                                {{$kt->nama_kategori}}
                                            </option>
                                        @endforeach
                                    </select>
                                    <div class="form-control-position">
                                        <i class="feather icon-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="contact-info-icon">Foto Barang</label>
                                <div class="position-relative has-icon-left">
                                    <input
                                    type="file"
                                    id="contact-info-icon"
                                    class="form-control @error("foto_barang") is-invalid @enderror"
                                    name="foto_barang">
                                    <div class="form-control-position">
                                        <i class="feather icon-smartphone"></i>
                                    </div>
                                    @error('foto_barang')
                                        <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('editor')
<script>
    CKEDITOR.replace( 'keterangan' );
</script>
@endpush
