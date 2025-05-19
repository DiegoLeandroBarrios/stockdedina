<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;


class ProductoController extends Controller
{
    public function crear()
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        
        return view('producto.crear');
    }

    public function guardar(Request $request)
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        
        $request->validate([
            'marca' => 'required|string|max:100',
            'articulo' => 'required|numeric',
            'color' => 'required|string|max:50',
            'tipo' => 'required|in:Mujer,Hombre,Unisex',
            'precio' => 'required|numeric',
            'descripcion' => 'required|string|max:255',
        ]);
    
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $database = $firestore->database();
        
        $now = Carbon::now('America/Argentina/Buenos_Aires')->toDateTimeString();

        $normalize = fn($value) => $value == 0 ? null : $value;

        $database->collection('producto')->add([
        'Marca' => $request->marca,
        'Articulo' => $request->articulo,
        'Color'  => $request->color,
        'Tipo'  => $request->tipo,
        'Precio'  => $request->precio,
        'Descripcion'  => $request->descripcion,
        '34'  => $normalize($request->numero1),
        '35'  => $normalize($request->numero2),
        '36'  => $normalize($request->numero3),
        '37'  => $normalize($request->numero4),
        '38'  => $normalize($request->numero5),
        '39'  => $normalize($request->numero6),
        '40'  => $normalize($request->numero7),
        '41'  => $normalize($request->numero8),
        '42'  => $normalize($request->numero9),
        'created_at' => $now,
        'updated_at' => $now,
    ]);
        return redirect()->route('home')->with('success', 'Producto creado correctamente');
    }
    public function home(Request $request)
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }

        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $database = $firestore->database();

        // Búsqueda simple
        $search = strtolower($request->input('search', ''));

        $documents = $database->collection('producto')->documents();

        $productos = collect($documents)
        ->filter(fn($doc) => $doc->exists())
        ->map(fn($doc) => [
            'id' => $doc->id(),
            'data' => $doc->data(),
        ])
        ->filter(function ($item) use ($search) {
            if ($search === '') return true;
    
            $data = $item['data'];
    
            return str_contains(strtolower($data['Marca'] ?? ''), $search) ||
                str_contains(strtolower($data['Articulo'] ?? ''), $search) ||
                str_contains(strtolower($data['Tipo'] ?? ''), $search);
        })
        ->sortByDesc(fn($item) => $item['data']['created_at'] ?? '')
        ->values();
    

        // Paginación
        $page = $request->input('page', 1);
        $perPage = 10;

        $paginado = new LengthAwarePaginator(
            $productos->slice(($page - 1) * $perPage, $perPage),
            $productos->count(),
            $perPage,
            $page,
            ['path' => url()->current()]
        );

        return view('home', [
            'productos' => $paginado,
            'search' => $search,
        ]);
    }

    public function editar($id){
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $document = $firestore->database()->collection('producto')->document($id)->snapshot();

        if (!$document->exists()) {
            return redirect()->route('home')->with('error', 'Producto no encontrado');
        }

        return view('producto.editar', ['id' => $id, 'producto' => $document->data()]);
    }

    public function actualizar(Request $request, $id){
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $database = $firestore->database();
        
        $now = Carbon::now('America/Argentina/Buenos_Aires')->toDateTimeString();

        $normalize = fn($value) => $value == 0 ? null : $value;

        $database->collection('producto')->document($id)->set([
            'Marca' => $request->marca,
            'Articulo' => $request->articulo,
            'Color'  => $request->color,
            'Tipo'  => $request->tipo,
            'Precio'  => $request->precio,
            'Descripcion'  => $request->descripcion,
            '34'  => $normalize($request->numero1),
            '35'  => $normalize($request->numero2),
            '36'  => $normalize($request->numero3),
            '37'  => $normalize($request->numero4),
            '38'  => $normalize($request->numero5),
            '39'  => $normalize($request->numero6),
            '40'  => $normalize($request->numero7),
            '41'  => $normalize($request->numero8),
            '42'  => $normalize($request->numero9),
            'updated_at' => $now, // Actualiza solo el updated_at
        ], ['merge' => true]);

        return redirect()->route('home')->with('success', 'Producto actualizado correctamente');
    }

    public function eliminar($id)
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $database = $firestore->database();
    
        $database->collection('producto')->document($id)->delete();
    
        return redirect()->route('home')->with('success', 'Producto eliminado correctamente');
    }

    public function ver($id)
    {
        if (!session()->has('firebase_user')) {
            return redirect()->route('login')->withErrors(['login_error' => 'Debes iniciar sesión']);
        }
        $factory = (new Factory)->withServiceAccount(config('firebase.credentials'));
        $firestore = $factory->createFirestore();
        $document = $firestore->database()->collection('producto')->document($id)->snapshot();

        if (!$document->exists()) {
            return redirect()->route('home')->with('error', 'Producto no encontrado');
        }

        return view('producto.ver', ['producto' => $document->data(), 'id' => $id]);
    }
    
}
