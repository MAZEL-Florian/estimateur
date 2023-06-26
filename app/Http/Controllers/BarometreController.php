<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Framework;
use App\Models\Metier;
use App\Models\Specialisation;
use App\Models\Secteur;
use App\Models\Stack;
use App\Models\Ville;
use Hamcrest\Core\HasToString;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class BarometreController extends Controller
{
    public function index(Request $request)
    {
        $secteurs = Secteur::all(['id', 'nom']);
        $metiers = Metier::all(['id', 'nom']);
        $stacks = Stack::all(['id', 'nom']);
        $specialisations = Specialisation::all(['id', 'nom']);
        $frameworks = Framework::all(['id', 'nom']);
        $villes = Ville::all(['id', 'nom']);
        return view('form', compact('secteurs', 'metiers', 'stacks', 'specialisations', 'frameworks'));
    }

    public function showForm()
    {
        $secteurs = Secteur::all();
        return view('form', ['secteurs' => $secteurs]);
    }

    public function getMetiers($id)
    {
        return Metier::where('secteur_id', $id)->get();
    }
    public function getVilles(){
        return Ville::all();
    }
    public function getStacks($id)
    {
        return DB::table('metier_stack')
        ->join('stacks', 'stacks.id', '=', 'metier_stack.stack_id')
        ->where('metier_stack.metier_id', $id)
        ->select('stacks.*')
        ->get();
    }
    public function getSpecialisations($id)
    {
        return DB::table('specialisation_stack')
    ->join('specialisations', 'specialisations.id', '=', 'specialisation_stack.specialisation_id')
    ->where('specialisation_stack.stack_id', $id)
    ->select('specialisations.*')
    ->get();
    }
    public function getFrameworks($id, $stackId)
    {
        logger($stackId);
        return DB::table('frameworks_specialisation')
        ->join('frameworks', 'frameworks.id', '=', 'frameworks_specialisation.framework_id')
        ->where('frameworks_specialisation.specialisation_id', $id)
        ->where('frameworks_specialisation.stack_id', $stackId)
        ->select('frameworks.*')
        ->distinct()
        ->get();
    }


    public function submitForm(Request $request)
    {
        $secteur = Secteur::find($request->input('secteur'));
        $metier = Metier::find($request->input('metier'));
        $stack = Stack::find($request->input('stack'));
        $specialisation = Specialisation::find($request->input('specialisation'));
        $framework = Framework::find($request->input('framework'));
        $statut = $request->input('xp');
        $ville = Ville::find($request->input('ville'));

    $salaire = DB::select('SELECT AVG(salaire) as avg_salaire FROM experiences
    WHERE (experiences.secteur_id = :secteur)
    AND (experiences.metier_id = :metier)
    AND (experiences.stack_id = :stack OR experiences.stack_id IS NULL)
    AND (experiences.specialisation_id = :specialisation OR experiences.specialisation_id IS NULL)
    AND (experiences.framework_id = :framework OR experiences.framework_id IS NULL)
    AND (experiences.statut_id = :statut)
    AND (experiences.ville_id = :ville)',
     ['secteur' => is_null($secteur) ? null : $secteur->id, 'metier' => is_null($metier) ? null : $metier->id, 'stack' => is_null($stack) ? null : $stack->id, 'specialisation' => is_null($specialisation) ? null : $specialisation->id, 'framework' => is_null($framework) ? null : $framework->id, 'statut' => $statut, 'ville' => $ville->id]
    );
    $salaire_avg = intval($salaire[0]->avg_salaire);
    // logger($secteur);
    // logger($metier);
    // logger($stack);
    // logger($specialisation);
    // logger($framework);
    // logger($statut);
    // logger($ville);
    // logger($salaire_avg);
    // logger($salaire);
    return response()->json(['moyenne' => $salaire_avg, 'secteur' => $secteur->nom, 'metier' => is_null($metier) ? null : $metier->nom, 'stack' => is_null($stack) ? null : $stack->nom, 'specialisation' => is_null($specialisation) ? null : $specialisation->nom, 'framework' => is_null($framework) ? null : $framework->nom]);
    }

    public function success($secteur, $metier, $stack, $specialisation, $framework)
    {

        $secteurs = Secteur::all(['id', 'nom']);

        $salaire = DB::select('SELECT AVG(salaire) as avg_salaire FROM experiences
        WHERE experiences.secteur_id = :secteur
        AND experiences.metier_id = :metier
        AND experiences.stack_id = :stack
        AND experiences.specialisation_id = :specialisation
        AND experiences.framework_id = :framework',
         ['secteur' => $secteur, 'metier' => $metier, 'stack' => $stack, 'specialisation' => $specialisation, 'framework' => $framework]
        );
        $salaire_avg = intval($salaire[0]->avg_salaire);

        $secteur = Secteur::find($secteur);
        $metier = Metier::find($metier);
        $stack = Stack::find($stack);
        $specialisation = Specialisation::find($specialisation);
        $framework = Framework::find($framework);


        return view('form', compact('secteurs','secteur', 'metier', 'stack', 'specialisation', 'framework', 'salaire_avg'));
    }

    public function estimation(Request $request)
    {
        return view('estimation');
    }
}
