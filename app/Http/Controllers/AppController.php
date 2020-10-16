<?php

namespace App\Http\Controllers;

use App\Models\App;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Redirect;
use Validator;

class AppController extends Controller
{
    public function index(Request $request)
    {
        // tim kiem app theo keyword tu form search
        $keyword = $request->get('keyword'); // lay keyword tu method GET
        $query = App::query(); // tao query moi trong App Model
        if ($keyword) { // neu co keyword
            $query->where('name', 'like', "%{$keyword}%"); // select cac ban ghi co name tuong tu voi keyword
        }
        $apps = $query->orderBy('id', 'desc')->get(); // thuc hien query orderby id, dua vao trong array $apps de return
        // dd($apps);
        return view('app.index', compact('apps'));
    }

    public function search(Request $request)
    {
        # search kem voi index roi
        $keyword = $request->get('keyword');
        $query = App::query();
        $query->where('name', 'like', "%{$keyword}%");
        $apps = $query->orderBy('id', 'desc');
        return view('test.search', compact('apps'));
    }

    public function create()
    {
        // view up lên 1 ứng dụng
        $categories = DB::table('categories')->get();
        $os = DB::table('operating_systems')->get();
        return view('app.create', compact('categories', 'os'));
    }

    // luu tru app moi tao
    public function store(Request $request)
    {
        $data = $request->all(); // lấy toàn bộ dữ liệu từ mảng $data
        // quy tắc xác thực
        $rule = [
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'os' => 'required',
        ];
        // tin hiển thị khi xác thực sai
        $message = [
            'name.required' => 'Tên ứng dụng không được để trống',
            'description.required' => 'Mô tả không được để trống',
            'category.required' => 'Bạn phải chọn danh mục',
            'os.reuired' => 'Bạn phải chọn hệ điều hành',
        ];
        // Validate dữ liệu
        $validator = Validator::make($data, $rule, $message);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Up ảnh app
        $filename = $_FILES['image']['name'];
        $id = $request->user()->id;
        $date = date("Ymd");
        $newName = $id . "-" . $date . "-{$filename}";
        $path = $request->file('image')->storeAs('image', $newName);

        // Nếu validate thành công thì lưu vào DB
        DB::table('apps')->insert([
            'name' => $data['name'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'user_id' => $id,
            'category_id' => $data['category'],
            'operating_system_id' => $data['os'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'image' => $path,
        ]);
        return redirect()->route('app.index');
    }

    public function edit($id)
    {
        # lấy thông tin của 1 app, show ra để edit
        $apps = DB::table('apps')->find($id);
        return view('page.edit', compact('apps'));
    }

    public function update(Request $request, $id)
    {
        # cập nhật lại thông tin vừa edit tại page edit

        $data = $request->all();
        DB::table('apps')->where('id', $id)->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'cost' => $data['cost'],
            'category_id' => $data['category_id'],
            'operating_system_id' => $data['operating_system_id'],
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect('page');
    }

    public function destroy($id)
    {
        # hủy thông tin app, xóa app
        DB::table('apps')->where('id', $id)->delete();
        return redirect('page');
    }

    public function show($id)
    {
        # hiển thị thông tin chi tiết của 1 app
        $apps = DB::table('apps')->where('id', $id)->get();
        return view('app.app', compact('apps'));
    }

    public function myApps($id)
    {
        $apps = DB::table('apps')->where('user_id', $id)->get();
        return view('app.myapps', compact('apps'));
    }

    public function cart()
    {
        return view('app.cart');
    }

    public function addToCart($id)
    {
        $app = App::find($id);
        if (!$app) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first app
        if (!$cart) {
            $cart = [
                    $id => [
                        "name" => $app->name,
                        // "quantity" => 1,
                        "description" => $app->description,
                        "cost" => $app->cost,
                        "category" => $app->category_id,
                        "os" => $app->operating_system_id,
                        "image" => $app->image,
                    ]
                ];
            session()->put('cart',$cart);
            return redirect()->back()->with('success', 'App added to cart successfully !');
        }
        // if cart not empty then check if this app exist then increment quantity
        if (isset($cart[$id])) {
            // $cart[$id]['quantity']++;
            session()->put('cart',$cart);
            return redirect()->back()->with('success', 'App added to cart successfully !');
        }

        // if item not exist in cart then add to cart with quantity = 1
        $cart[$id] = [
            "name" => $app->name,
            // "quantity" => 1,
            "description" => $app->description,
            "cost" => $app->cost,
            "category" => $app->category_id,
            "os" => $app->operating_system_id,
            "image" => $app->image,
        ];
        session()->put('cart',$cart);
        return redirect()->back()->with('success', 'App added to cart successfully !');
    }

    // update neu thay doi so luong tren cac san pham -> vi la app nen ko co so luong -> khong can updateCart cho app
    // public function updateCart(Request $request)
    // {
    //     if ($request->id) { /* and $request->quantity */
    //         $cart = session()->get('cart');
    //         // $cart[$request->id]['quantity'] = $request->quantity;
    //         session()->put('cart',$cart);
    //         session()->flash('success','Cart updated successfully');
    //     }
    // }

    // xoa khoi cart
    public function removeCart(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart',$cart);
            }
            session()->flash('success','App removed successfully');
        }
    }
}
