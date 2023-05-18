export interface IUser {
  id?: number,
  name: string,
  email: string,
  created_at?: number,
  updated_at?: number,
  password?: string,
  confirm_password?: string,
}

export interface IRegisteringUser extends IUser {
  password: string,
  confirm_password: string,
}

export interface LoggedInUser extends IUser {
  id: number
  created_at: number,
  updated_at: number,
}
