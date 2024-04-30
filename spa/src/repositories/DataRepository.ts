const baseUrl = 'https://thesis-project.local.io/api/json'

export default {
  getGlobalData: (): Promise<Exclude<Data, 'pages'>> =>
    fetch(`${baseUrl}/global`).then((response) => response.json()),
  getPageData: (index: number): Promise<Page> =>
    fetch(`${baseUrl}/pages/${index}`).then((response) => response.json()),
}
