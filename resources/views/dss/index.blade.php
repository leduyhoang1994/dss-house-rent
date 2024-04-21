<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            DSS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <header class="text-center">
                    <h1 class="text-xl">Hệ thống trợ giúp ra quyết định hỗ trợ tìm phòng trọ</h1>
                </header>
                <form method="GET" action="{{ route('dss-result') }}">
                    @csrf

                    <div class="mt-2">
                        <x-label for="name" value="{{ __('Tên') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="username" />
                    </div>

                    <div class="mt-2">
                        <x-label for="b1_income" value="{{ __('Thu nhập tháng') }}" />
                        <x-input id="b1_income" class="block mt-1 w-full" type="number" name="b1_income" :value="old('b1_income')" required />
                    </div>

                    <div class="mt-2">
                        <x-label for="b2_transport" value="{{ __('Phương tiện di chuyển') }}" />

                        <div class="flex items-center">
                            <x-input id="b2_transport_bus" class="block mr-1" type="radio" name="b2_transport" value="0" required />
                            <x-label for="b2_transport_bus" value="{{ __('Xe bus') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b2_transport_self" class="block mr-1" type="radio" name="b2_transport" value="1" required />
                            <x-label for="b2_transport_self" value="{{ __('Tự đi') }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label for="b3_work" value="{{ __('Làm thêm') }}" />

                        <div class="flex items-center">
                            <x-input id="b3_work1" class="block mr-1" type="radio" name="b3_work" value="1" required />
                            <x-label for="b3_work1" value="{{ __('Có') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b3_work0" class="block mr-1" type="radio" name="b3_work" value="0" required />
                            <x-label for="b3_work0" value="{{ __('Không') }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label for="b4_mates" value="{{ __('Ở ghép') }}" />

                        <div class="flex items-center">
                            <x-input id="b4_mates1" class="block mr-1" type="radio" name="b4_mates" value="0" required />
                            <x-label for="b4_mates1" value="{{ __('Có') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b4_mates0" class="block mr-1" type="radio" name="b4_mates" value="1" required />
                            <x-label for="b4_mates0" value="{{ __('Không') }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label for="b5_meal" value="{{ __('Ăn uống') }}" />

                        <div class="flex items-center">
                            <x-input id="b5_meal1" class="block mr-1" type="radio" name="b5_meal" value="1" required />
                            <x-label for="b5_meal1" value="{{ __('Tự nấu') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b5_meal0" class="block mr-1" type="radio" name="b5_meal" value="0" required />
                            <x-label for="b5_meal0" value="{{ __('Ăn ngoài') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b5_meal05" class="block mr-1" type="radio" name="b5_meal" value="0.5" required />
                            <x-label for="b5_meal05" value="{{ __('Cả 2') }}" />
                        </div>
                    </div>

                    <div class="mt-2">
                        <x-label for="b6_assets" value="{{ __('Đã có đồ') }}" />

                        <div class="flex items-center">
                            <x-input id="b6_assets1" class="block mr-1" type="radio" name="b6_assets" value="1" required />
                            <x-label for="b6_assets1" value="{{ __('Có') }}" />
                        </div>

                        <div class="flex items-center">
                            <x-input id="b6_assets0" class="block mr-1" type="radio" name="b6_assets" value="0" required />
                            <x-label for="b6_assets0" value="{{ __('Không') }}" />
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit">Gợi ý</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
