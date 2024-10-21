<div>
    <style>
        @charset "UTF-8";
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");
        * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        }
                
        body {
            align-items: center;
            justify-content: center;
            min-height: 100vh;  
            font-family: "Poppins", sans-serif;
            color: #141a4e;
            background-color: #f2f6f9;
            font-size: 1.1rem;
        }
        
        /* Page Wrapper/Container Style */
        .container {
        width: 100%;
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 15px;
        }
        
        /* Responsive Table Style */
        .responsive-table {
        background-color: #fefefe;
        border-collapse: collapse;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.02);
        width: 100%;
        margin: 2rem 0;
        overflow: hidden;
        }
        .responsive-table__row {
        display: grid;
        border-bottom: 1px solid #edeef2;
        padding: 0 1.5rem;
        }
        @media (min-width: 768px) {
        .responsive-table__row {
            grid-template-columns: 2fr 1fr 2fr 2fr 1fr;
        }
        }
        @media (min-width: 768px) and (max-width: 991px) {
        .responsive-table__row {
            grid-template-columns: 1fr 2fr 1fr;
        }
        }
        .responsive-table__row th,
        .responsive-table__row td {
        padding: 1rem;
        }
        .responsive-table__head {
        background-color: #e1e8f2;
        }
        @media (max-width: 991px) {
        .responsive-table__head {
            display: none;
        }
        }
        .responsive-table__head__title {
        display: flex;
        align-items: center;
        font-weight: 500;
        text-transform: capitalize;
        }
        .responsive-table__body .responsive-table__row {
        transition: 0.1s linear;
        transition-property: color, background;
        }
        .responsive-table__body .responsive-table__row:last-child {
        border-bottom: none;
        }
        .responsive-table__body .responsive-table__row:hover {
        color: #ffffff;
        background-color: #fb4f83;
        }
        .responsive-table__body__text {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        }
        .responsive-table__body__text::before {
        margin-right: 1rem;
        font-weight: 600;
        text-transform: capitalize;
        }
        @media (max-width: 991px) {
        .responsive-table__body__text::before {
            content: attr(data-title) " :";
        }
        }
        @media (max-width: 400px) {
        .responsive-table__body__text::before {
            width: 100%;
            margin-bottom: 1rem;
        }
        }
        .responsive-table__body__text--name {
        font-weight: 600;
        }
        @media (min-width: 768px) {
        .responsive-table__body__text--name::before {
            display: none;
        }
        }
        @media (min-width: 768px) and (max-width: 991px) {
        .responsive-table__body__text--name {
            grid-column: 1/2;
            flex-direction: column;
        }
        }
        @media (min-width: 768px) and (max-width: 991px) {
        .responsive-table__body__text--status, .responsive-table__body__text--types, .responsive-table__body__text--update {
            grid-column: 2/3;
        }
        }
        @media (min-width: 768px) and (max-width: 991px) {
        .responsive-table__body__text--country {
            grid-column: 3/-1;
        }
        }
        @media (min-width: 768px) and (max-width: 991px) {
        .responsive-table__body__text--name, .responsive-table__body__text--country {
            grid-row: 2;
        }
        }
        
        /* SVG Up Arrow Style */
        .up-arrow {
        height: 100%;
        max-height: 1.8rem;
        margin-left: 1rem;
        }
        
        /* SVG User Icon Style */
        .user-icon {
        width: 100%;
        max-width: 4rem;
        height: auto;
        margin-right: 1rem;
        }
        
        /* Status Indicator Style */
        .status-indicator {
        display: inline-block;
        width: 1.8rem;
        height: 1.8rem;
        border-radius: 50%;
        background: #222222;
        margin-right: 0.5rem;
        }
        .status-indicator--active {
        background: #25be64;
        }
        .status-indicator--inactive {
        background: #dadde4;
        }
        .status-indicator--new {
        background: #febf02;
        }
        .status-indicator--ban {
        background: red;
        }
    </style>
    
    <div class="container">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
                <a href="{{route('admin.category.add')}}" class="btn btn-success float-end">Add New Category</a>
            </div>
        </div>

        @if(Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
        @endif

        <table class="responsive-table">
            <!-- Responsive Table Header Section -->
            <thead class="responsive-table__head">
                <tr class="responsive-table__row">
                    <th class="responsive-table__head__title responsive-table__head__title--name">#
                    </th>
                    <th class="responsive-table__head__title responsive-table__head__title--status">Name</th>
                    <th class="responsive-table__head__title responsive-table__head__title--country">Code</th>
                    <th class="responsive-table__head__title responsive-table__head__title--update">Action</th>
                </tr>
            </thead>
            <!-- Responsive Table Body Section -->
            <tbody class="responsive-table__body">
                @foreach($categories as $category)
                    <tr class="responsive-table__row">
                        <td class="responsive-table__body__text responsive-table__body__text--name">
                                 {{$category->id}}                 
                        </td>
                        <td class="responsive-table__body__text responsive-table__body__text--status">
                            {{$category->name}}                        
                        </td>
                        <td class="responsive-table__body__text responsive-table__body__text--country">{{$category->slug}}</td>
                        <td class="responsive-table__body__text responsive-table__body__text--update">
                            <a href="{{route('admin.category.edit',['category_id'=>$category->id])}}" class="text-info">Edit</a>
                            <a href="#" class="text-danger" onclick="deleteConfirmation({{$category->id}})" style="margin-left: 20px;">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- ***********************************
    **** Modal box ********************
    *********************************** --}}
    <div class="modal" id="deleteConfirmation">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body pb-30 pt-30">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4 class="pb-3">Do you want to delete this record?</h4>
                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                            <button type="button" class="btn btn-danger" onclick="deleteCategory()">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    
        // Select thead titles from Dom
        const headTitleName = document.querySelector(
            ".responsive-table__head__title--name"
        );
        const headTitleStatus = document.querySelector(
            ".responsive-table__head__title--status"
        );
        const headTitleTypes = document.querySelector(
            ".responsive-table__head__title--types"
        );
        const headTitleUpdate = document.querySelector(
            ".responsive-table__head__title--update"
        );
        const headTitleCountry = document.querySelector(
            ".responsive-table__head__title--country"
        );
        
        // Select tbody text from Dom
        const bodyTextName = document.querySelectorAll(
            ".responsive-table__body__text--name"
        );
        const bodyTextStatus = document.querySelectorAll(
            ".responsive-table__body__text--status"
        );
        const bodyTextTypes = document.querySelectorAll(
            ".responsive-table__body__text--types"
        );
        const bodyTextUpdate = document.querySelectorAll(
            ".responsive-table__body__text--update"
        );
        const bodyTextCountry = document.querySelectorAll(
            ".responsive-table__body__text--country"
        );
        
        // Select all tbody table row from Dom
        const totalTableBodyRow = document.querySelectorAll(
            ".responsive-table__body .responsive-table__row"
        );
        
        // Get thead titles and append those into tbody table data items as a "data-title" attribute
        for (let i = 0; i < totalTableBodyRow.length; i++) {
            bodyTextName[i].setAttribute("data-title", headTitleName.innerText);
            bodyTextStatus[i].setAttribute("data-title", headTitleStatus.innerText);
            // bodyTextTypes[i].setAttribute("data-title", headTitleTypes.innerText);
            bodyTextUpdate[i].setAttribute("data-title", headTitleUpdate.innerText);
            bodyTextCountry[i].setAttribute("data-title", headTitleCountry.innerText);
        }
        
    </script>    

@push('scripts')
    <script>
        function deleteConfirmation(id)
        {
            @this.set('category_id',id);
            $('#deleteConfirmation').modal('show');
        }
        function deleteCategory()
        {
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush