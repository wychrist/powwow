export type MenuItem = {
  id: number;
  label: string;
  link?: string;
  icon?: string | undefined;
  active: boolean;
  hasActiveChild: boolean;
  children: Array<MenuItem>;
  parentID: number | null;
}
