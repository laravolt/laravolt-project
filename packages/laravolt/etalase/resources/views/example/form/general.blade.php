<form action="" class="ui form">
    <div class="field">
        <label for="">Text</label>
        <input type="text">
    </div>
    <div class="field disabled">
        <label for="">Text Disabled</label>
        <input type="text" disabled>
    </div>
    <div class="field">
        <label for="">Textarea</label>
        <textarea name="" id="" cols="30" rows="3"></textarea>
    </div>
    <div class="field disabled">
        <label for="">Textarea Disabled</label>
        <textarea name="" id="" cols="30" rows="3" disabled></textarea>
    </div>
    <div class="field error">
        <label>Input with error</label>
        <input type="text" name="first-name" value="Jon Dodo">
    </div>

    <div class="field">
        <label>Hobby</label>
        <div class="inline fields">
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="hobby[]">
                    <label>Coding</label>
                </div>
            </div>
            <div class="field">
                <div class="ui checkbox">
                    <input type="checkbox" name="hobby[]">
                    <label>Gaming</label>
                </div>
            </div>
        </div>
    </div>

    <div class="field">
        <label>Gender</label>
        <div class="field">
            <div class="ui checkbox radio">
                <input type="radio" name="gender">
                <label>Male</label>
            </div>
        </div>
        <div class="field">
            <div class="ui checkbox radio">
                <input type="radio" name="gender">
                <label>Female</label>
            </div>
        </div>
    </div>

    <div class="field">
        <label>Select</label>
        <select class="ui dropdown search">
            <option value="1">Indonesia</option>
            <option value="2">Malaysia</option>
            <option value="3">Thailand</option>
        </select>
    </div>

    <div class="field disabled">
        <label>Select Disabled</label>
        <select class="ui dropdown search" disabled>
            <option value="1">Indonesia</option>
            <option value="2">Malaysia</option>
            <option value="3">Thailand</option>
        </select>
    </div>

    <div class="field">
        <label>Multiple Select</label>
        <select class="ui dropdown search" multiple>
            <option value="1">Indonesia</option>
            <option value="2">Malaysia</option>
            <option value="3">Thailand</option>
        </select>
    </div>

</form>
