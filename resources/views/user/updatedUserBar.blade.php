<div class="row user-row-info">
    <div class="col-md-2">
        <i class="fas fa-signature"></i>
        {{ Auth::user()->name }}
    </div>
    <div class="col-md-2">
        <i class="fas fa-long-arrow-alt-up"></i>
        {{ Auth::user()->level }}
    </div>
    <div class="col-md-2">
        <i class="fas fa-angle-double-up"></i>
        {{ Auth::user()->exp }}
    </div>
    <div class="col-md-2">
        <i class="fas fa-bolt"></i>
        {{ Auth::user()->energy }}
    </div>
    <div class="col-md-2">
        <i class="fas fa-coins"></i>
        {{ Auth::user()->coins }}
        <i class="far fa-gem"></i>
        {{ Auth::user()->gems }}
    </div>
</div>