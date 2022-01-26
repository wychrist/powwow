import { getRepository } from "typeorm";
import { Setting } from './entity/Setting'
import { ISettingEntry } from "./type/Interfaces";

let settings: ISettingEntry

export function getSettingRepo() {
    return getRepository(Setting)
}

export function getSettings(): ISettingEntry {
    if (!settings) {
        settings = {}
        getSettingRepo()
            .find()
            .then((rows) => {
                rows.forEach((row) => {
                    settings[row.name] = row.value
                })
            })
            .catch((error) => {
                throw error
            })
    }

    return settings;
}
