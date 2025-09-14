<nav class="navbar-part bg-navbar">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="navbar-content">
                    <ul class="navbar-list">
                        @php
                            $categories = App\Models\Category::where('is_active', 1)->get();
                        @endphp
                        @foreach($categories as $category)
                        <li class="navbar-item dropdown">
                            <a class="navbar-link" href="{{ route('category.products', $category->id) }}" style="background-color: transparent; transition: background-color 0.3s ease; border-radius: 4px; padding: 8px 12px;" onmouseover="this.style.backgroundColor='#5A3CE0'" onmouseout="this.style.backgroundColor='transparent'">
                                {{ $category->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
