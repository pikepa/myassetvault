<nav class="h-full w-64 p-4  border-r-4 ">
    <div class="flex h-screen flex-col">
        <div class="p-2 py-4 rounded bg-blue-400 text-center text-xl">My Owned Asset Vault</div>
            <ul class="p-4" >
                <li></li>
                <li> <a wire:navigate href="{{ route('asset.listing',['type' => '']) }}" 
                    @class(['text-blue-600 font-semibold' => request()->is('asset/listing')])>Assets & Liabilities</a></li>
                <div class="pl-2">
                    <li class="border-b mb-2 pt-2 font-semibold">Assets</li>
                    @foreach(App\Enums\Assets\AssetType::cases() as $item)
                    @if($item->assetClass() === 'Asset')
                    <li> <a wire:navigate href="{{ route('asset.listing',['type' => $item->name ]) }}" @class(['text-blue-600 font-semibold' => request()->is('{{ $item->name }}')])>{{ $item->label() }}</a></li>
                    @endif
                    @endforeach
                </div>
                <div class="pl-2">
                    <li class="border-b mb-2 pt-4 font-semibold">Liabilities</li>
                    @foreach(App\Enums\Assets\AssetType::cases() as $item)
                    @if($item->assetClass() === 'Liability')
                    <li> <a wire:navigate href="{{ route('asset.listing',['type' => $item->name ]) }}" @class(['text-blue-600 font-semibold' => request()->is('{{ $item->name }}')])>{{ $item->label() }}</a></li>
                    @endif
                    @endforeach
                </div>
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