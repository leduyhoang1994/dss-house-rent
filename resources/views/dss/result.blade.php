<?php
/**
 * @var \Illuminate\Support\Collection|\App\Models\House[] $ratedHouses ;
 * @var array $studentInfo ;
 */
?>
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
                    <h1 class="text-2xl">Hệ thống trợ giúp ra quyết định hỗ trợ tìm phòng trọ</h1>
                    <h1 class="text-2xl">KẾT QUẢ</h1>
                </header>

                <ul>
                    <p class="text-xl my-1">I. Thông tin sinh viên:</p>
                    <li>
                        <b>Tên:</b> {{ $studentInfo['name'] }}
                    </li>
                    <li>
                        <b>Thu nhập:</b> {{ number_format($studentInfo['b1_income']) }} <small>vnđ</small>
                    </li>
                    <li>
                        <b>Phương tiện di chuyển:</b> {{ $studentInfo['b2_transport'] ? 'Tự đi' : 'Xe bus' }}
                    </li>
                    <li>
                        <b>Làm thêm:</b> {{ $studentInfo['b3_work'] ? 'Có' : 'Không' }}
                    </li>
                    <li>
                        <b>Ở ghép:</b> {{ $studentInfo['b4_mates'] ? 'Không' : 'Có' }}
                    </li>
                    <li>
                        <b>Ăn uống:</b> {{ $studentInfo['b5_meal'] == 1 ? 'Tự nấu' : ($studentInfo['b5_meal'] == 0.5 ? 'Tự nấu + ăn ngoài' : 'Ăn ngoài') }}
                    </li>
                    <li>
                        <b>Sẵn đồ:</b> {{ $studentInfo['b6_assets'] ? 'Có' : 'Không' }}
                    </li>
                </ul>

                <p class="text-xl my-1">II. Thông tin phòng trọ:</p>
                @if(count($ratedHouses) == 0)
                    Không có căn nào phù hợp với nhu cầu của bạn !
                @else
                    <table class="table text-center">
                        <thead>
                        <tr>
                            <td>Tên</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->name }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Đánh giá</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ round($house->rate, 3) }}
                                </td>
                            @endforeach
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Giá cả</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ number_format($house->a1_price) }} <small>vnđ</small>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Cơ sở vật chất</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a2_facility ? 'Full đồ' : 'Không đồ' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Nơi đỗ xe</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a3_parking ? 'Có' : 'Không' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Giờ giới nghiêm</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a4_time ? 'Có' : 'Không' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Số người ở tối đa</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a5_roomate }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Nhà vệ sinh</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a6_toilet ? 'Riêng' : 'Chung' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Nhà bếp</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a7_kitchen ? 'Riêng' : 'Chung' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Gần trung tâm/khu dân cư</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a8_near_center ? 'Có' : 'Không' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Khoảng cách</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a9_distance }} <small>km</small>
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Gần bến xe bus</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a10_bus ? 'Có' : 'Không' }}
                                </td>
                            @endforeach
                        </tr>
                        <tr>
                            <td>Có bảo vệ</td>
                            @foreach($ratedHouses as $house)
                                <td>
                                    {{ $house->a11_security ? 'Có' : 'Không' }}
                                </td>
                            @endforeach
                        </tr>
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-guest-layout>
