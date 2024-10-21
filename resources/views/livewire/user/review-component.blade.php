<div>
    <style>
        .rating {
        display: inline-block;
        position: relative;
        height: 50px;
        line-height: 50px;
        font-size: 50px;
        }

        .rating label {
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        cursor: pointer;
        }

        .rating label:last-child {
        position: static;
        }

        .rating label:nth-child(1) {
        z-index: 5;
        }

        .rating label:nth-child(2) {
        z-index: 4;
        }

        .rating label:nth-child(3) {
        z-index: 3;
        }

        .rating label:nth-child(4) {
        z-index: 2;
        }

        .rating label:nth-child(5) {
        z-index: 1;
        }

        .rating label input {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        }

        .rating label .icon {
        float: left;
        color: transparent;
        }

        .rating label:last-child .icon {
        color: rgb(170, 165, 165);
        }

        .rating:not(:hover) label input:checked ~ .icon,
        .rating:hover label:hover input ~ .icon {
        color: #FF9529;
        }

        .rating label input:focus:not(:checked) ~ .icon:last-child {
        color: #000;
        text-shadow: 0 0 5px #FF9529;
        }
    </style>
    <div class="row bg-info">
        <div class="col-4"></div>
        <div class="col comment-form card bg-secondary mt-3">
            <h4 class="mb-15 card-header text-info">Add a review</h4>
            <div class="row card-body">
                    <form  id="commentForm" wire:submit.prevent="review">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group bg-white">
                                    <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment" wire:model="review"></textarea>
                                </div>
                            </div>
                        </div>
                        <h4 class="text-white">Share Your Experiences</h4>
                        <div class="rating">
                            <label>
                            <input type="radio" name="stars" value="1" wire:model="stars" />
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            </label>
                            <label>
                            <input type="radio" name="stars" value="2" wire:model="stars"/>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            </label>
                            <label>
                            <input type="radio" name="stars" value="3" wire:model="stars"/>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>   
                            </label>
                            <label>
                            <input type="radio" name="stars" value="4" wire:model="stars"/>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            </label>
                            <label>
                            <input type="radio" name="stars" value="5" wire:model="stars"/>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            <span class="icon"><i class="fa-solid fa-star" ></i></span>
                            </label>
                        </div>
                            <div class="form-group">
                            <button type="submit" class="btn-primary">Submit
                                Review</button>
                        </div>
                    </form>
            </div>
        </div>
        <div class="col-3"></div>
    </div>
</div>
