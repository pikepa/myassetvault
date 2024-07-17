<nav class="h-full w-64 p-4  border-r-4 ">
    <div class="flex h-screen flex-col">
        <div class="p-2 py-4 rounded bg-blue-400 text-center text-xl">My Asset Vault</div>
            <ul class="p-2" >
                <li class="border-b mb-2"> <a wire:navigate href="{{ route('party.listing') }}" @class(['text-blue-600 font-semibold' => request()->is('home')])>Assets & Liabilities</a></li>
                <li> <a wire:navigate href="/ord" @class(['text-blue-600 font-semibold' => request()->is('ord')])>Our Property</a></li>
                <li> <a wire:navigate href="/lif" @class(['text-blue-600 font-semibold' => request()->is('lif')])>Our Shares</a></li>
                <li> <a wire:navigate href="/stu" @class(['text-blue-600 font-semibold' => request()->is('stu')])>Our Liabilities</a></li>
                <li> <a wire:navigate href="/inst" @class(['text-blue-600 font-semibold' => request()->is('inst')])>Institutional Members</a></li>

                <br>
                <li class="border-b mb-2"> <a wire:navigate href="{{ route('transaction.listing') }}" @class(['text-blue-600 font-semibold' => request()->is('/transactions/index')])>All Transactions</a></li>
                <br>
                @can('viewAny', auth()->user())
                    <li class="border-b mb-2"> <a wire:navigate href="{{ route('user.listing') }}" @class(['text-blue-600 font-semibold' => request()->is('user/listing')])>All Users</a></li>
                @endcan
                <br>
                <li> <a wire:navigate href="{{ route('welcome') }}" >Front Page</a></li>
                <br>
                <form method="POST" action={{ route('logout') }}>
                    @csrf
                    <button type="submit">Logout</button>
                </form>
                
            </ul>
        </div>
    </div>
</nav>