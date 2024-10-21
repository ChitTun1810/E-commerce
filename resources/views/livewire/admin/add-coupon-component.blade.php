<div>
    <div class="row p-5 bg-dark">
        <div class="col-4"></div>
        <div class="col-4">
            <div class="card">
                <h3 class="card-header text-info"> Add New Coupon</h3>
                <div class="card-body">
                    <form class="form-horizontal" wire:submit.prevent="addcoupon">
                        <div class="form-group">
                            <label >Coupon Code</label>
                            <div >
                                <input class="form-control" type="text" placeholder="Coupon Code" wire:model="code">
                                @error('code') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Coupon Type</label>
                            <div >
                                <select class="form-select" wire:model="type">
                                    <option value="">Select</option>
                                    <option value="percent">Percent</option>    
                                    <option value="fixed">Fixed</option>    
                                </select>                        
                                @error('code') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label >Coupon Value</label>
                            <div >
                                <input class="form-control" type="text" placeholder="Coupon Value" wire:model="value">
                                @error('value') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label >Quantities</label>
                            <div wire:ignore>
                                <input class="form-control" type="number" placeholder="Card-Quantities" wire:model="quantities">
                                @error('quantities') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
        
                        <div class="form-group">
                            <label >Amount Limit</label>
                            <div >
                                <input class="form-control" type="text" placeholder="Cart Value" wire:model="amount_limit">
                                @error('amount_limit') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                        </div>
                        <button class="btn btn-secondary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @livewire('footer-component')
</div>
