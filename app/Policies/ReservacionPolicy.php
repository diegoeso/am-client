<?php

namespace App\Policies;

use App\Models\Reservacion;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReservacionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {

        $roles = array('admin', 'collector', 'control', 'conveniant', 'quality', 'recepcionist', 'reserver', 'sales', 'supervisor');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function view(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'collector', 'quality', 'reserver', 'control');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function update(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function delete(User $user, Reservacion $reservacion)
    {
        $roles = array('admin');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function restore(User $user, Reservacion $reservacion)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function forceDelete(User $user, Reservacion $reservacion)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function pagos(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function cupon_confirmacion(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function cupon_cobro(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function habitaciones_contratos(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function asignar(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }
    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function ajustes_reservacion(User $user, Reservacion $reservacion)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\Reservacion  $reservacion
     * @return mixed
     */
    public function vetarifah(User $user)
    {
        $roles = array('admin', 'reserver');
        if (in_array($user->role, $roles)) {
            if ($user->vetarifah == 1) {
                return true;
            }
        }
        return false;
    }

}
