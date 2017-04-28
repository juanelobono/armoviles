require 'test_helper'

class UsersControllerTest < ActionController::TestCase
  setup do
    @user = users(:one)
  end

  test "should get index" do
    get :index
    assert_response :success
    assert_not_nil assigns(:users)
  end

  test "should get new" do
    get :new
    assert_response :success
  end

  test "should create user" do
    assert_difference('User.count') do
      post :create, user: { activo: @user.activo, apellido: @user.apellido, departamento: @user.departamento, dni: @user.dni, domicilio: @user.domicilio, email: @user.email, fecha_nacimiento: @user.fecha_nacimiento, legajo: @user.legajo, nombre: @user.nombre, password: @user.password, piso: @user.piso, telefono: @user.telefono }
    end

    assert_redirected_to user_path(assigns(:user))
  end

  test "should show user" do
    get :show, id: @user
    assert_response :success
  end

  test "should get edit" do
    get :edit, id: @user
    assert_response :success
  end

  test "should update user" do
    patch :update, id: @user, user: { activo: @user.activo, apellido: @user.apellido, departamento: @user.departamento, dni: @user.dni, domicilio: @user.domicilio, email: @user.email, fecha_nacimiento: @user.fecha_nacimiento, legajo: @user.legajo, nombre: @user.nombre, password: @user.password, piso: @user.piso, telefono: @user.telefono }
    assert_redirected_to user_path(assigns(:user))
  end

  test "should destroy user" do
    assert_difference('User.count', -1) do
      delete :destroy, id: @user
    end

    assert_redirected_to users_path
  end
end
