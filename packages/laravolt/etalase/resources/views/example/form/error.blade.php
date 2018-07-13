<form class="ui form">
    <div class="field">
        <label>First Name</label>
        <input type="text" name="first-name" value="Jon Dodo">
    </div>
    <div class="field error">
        <label>Last Name</label>
        <input type="text" name="last-name" placeholder="Last Name">
    </div>
    <div class="field error">
        <label>Nationality</label>
        <select class="ui dropdown search">
            <option value="1">Indonesia</option>
            <option value="2">Malaysia</option>
            <option value="3">Thailand</option>
        </select>
    </div>

    <button class="ui button primary" type="submit">Submit</button>
    <a class="ui button">Cancel</a>
</form>
