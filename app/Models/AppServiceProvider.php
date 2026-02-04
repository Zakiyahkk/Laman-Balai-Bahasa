use Illuminate\Pagination\Paginator;

public function boot() {
    Paginator::useBootstrapFour();
}