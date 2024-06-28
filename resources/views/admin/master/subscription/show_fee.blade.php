<div class="row">
    @for ($i = 1; $i <= $course->study_duration; $i++)
        <div class="col-md-3 mt-4">
            <label for="inputYear{{ $i }}" class="form-label" style="color: #000000!important;">{{ strval($i) }} Year Fee</label>
            <input type="number" class="form-control" name="study_duration[]" id="inputYear{{ $i }}" step="1" min="0" required>
        </div>
    @endfor
</div>