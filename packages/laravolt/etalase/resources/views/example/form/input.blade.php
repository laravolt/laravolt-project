<form class="ui form">
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('Username')->prependLabel('@') !!}
    </div>
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('Username')->appendLabel('.00', 'basic') !!}
    </div>
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('Username')->prependLabel('$', 'basic')->appendLabel('.00') !!}
    </div>
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('Email')->prependIcon('mail') !!}
    </div>
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('')->appendIcon('check') !!}
    </div>
    <div class="field">
        {!! SemanticForm::input('username')->placeholder('')->appendIcon('check', 'green') !!}
    </div>
    <div class="field">
        <div class="ui icon input loading">
            <input type="text" placeholder="Search...">
            <i class="search icon"></i>
        </div>
    </div>

    <div class="field">
        <div class="ui right labeled input">
            <input type="text" placeholder="Find domain">
            <div class="ui dropdown label">
                <div class="text">.com</div>
                <i class="dropdown icon"></i>
                <div class="menu">
                    <div class="item">.com</div>
                    <div class="item">.net</div>
                    <div class="item">.org</div>
                </div>
            </div>
        </div>
    </div>

    <div class="field">
        <div class="ui action input">
            <input type="text" placeholder="Search...">
            <select class="ui compact selection dropdown">
                <option value="all">All</option>
                <option selected="" value="articles">Articles</option>
                <option value="products">Products</option>
            </select>
            <div type="submit" class="ui button">Search</div>
        </div>
    </div>
</form>
