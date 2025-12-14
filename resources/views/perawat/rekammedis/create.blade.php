<!-- Contoh Form yang BENAR untuk Input Tindakan -->
<div class="tindakan-item mb-3">
    <div class="row">
        <div class="col-md-6">
            <label>Tindakan <span class="text-danger">*</span></label>
            <select name="tindakan[]" class="form-control" required>
                <option value="">-- Pilih Tindakan --</option>
                @foreach($tindakan as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">
                        [{{ $t->kode }}] {{ $t->deskripsi_tindakan_terapi }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-5">
            <!-- PENTING: name="detail[]" harus array dengan index yang sama -->
            <label>Detail / Keterangan</label>
            <input type="text" 
                   name="detail[]" 
                   class="form-control" 
                   placeholder="Contoh: dosis standart, vitamin c, dll">
        </div>
        <div class="col-md-1">
            <label>&nbsp;</label>
            <button type="button" class="btn btn-danger btn-sm btn-block remove-tindakan">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
</div>

<!-- JavaScript untuk Add/Remove Tindakan -->
<script>
$(document).ready(function() {
    let tindakanCount = 1;

    $('#add-tindakan').click(function() {
        tindakanCount++;
        const newTindakan = `
            <div class="tindakan-item mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <select name="tindakan[]" class="form-control" required>
                            <option value="">-- Pilih Tindakan --</option>
                            @foreach($tindakan as $t)
                                <option value="{{ $t->idkode_tindakan_terapi }}">
                                    [{{ $t->kode }}] {{ $t->deskripsi_tindakan_terapi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="detail[]" class="form-control" 
                               placeholder="Detail/Keterangan (opsional)">
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger btn-sm btn-block remove-tindakan">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
        $('#tindakan-container').append(newTindakan);
        updateRemoveButtons();
    });

    $(document).on('click', '.remove-tindakan', function() {
        $(this).closest('.tindakan-item').remove();
        tindakanCount--;
        updateRemoveButtons();
    });

    function updateRemoveButtons() {
        if (tindakanCount > 1) {
            $('.remove-tindakan').show();
        } else {
            $('.remove-tindakan').hide();
        }
    }
});
</script>